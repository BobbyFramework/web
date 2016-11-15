<?php

namespace BobbyFramework\Web;

use ArrayAccess;

/**
 * Class View
 * @package BobbyFramework\Web
 */
class View implements ArrayAccess, ViewInterface
{
    /**
     * NO_VIEW
     */
    const NO_VIEW = 1;

    /**
     * @var array data vars $vars
     */
    protected $vars = [];

    /**
     * @var null|string $extension
     */
    protected $extension = null;
    /**
     * @var null|string $path
     */
    protected $path;

    /**
     * View constructor.
     * @param string $extension
     */
    public function __construct($extension = '.php')
    {
        $this->setExtension($extension);
    }

    /**
     * @param string $extension
     * @return View $this
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return View $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @param string $var
     * @param string $value
     * @return View $this
     */
    public function setVar($var, $value)
    {
        if (!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException('The variable name must be a non-null character string');
        }
        $this->vars[$var] = $value;

        return $this;
    }

    /**
     * @param string $vars
     * @param null|string $value
     * @return View $this
     */
    public function setVars($vars, $value = null)
    {
        if (is_array($vars)) {
            $this->vars = array_merge($this->vars, $vars);
        } else {
            $this->vars[$vars] = $value;
        }
        return $this;
    }

    /**
     * @param string $file
     * @throws NoViewException
     */
    public function exists($file)
    {
        if (!file_exists($file)) {
            throw new NoViewException($file, 'Not found view' . $file, self::NO_VIEW);
        }
    }

    /**
     * @param string $file
     * @param array $data
     * @param bool $ext
     * @return string
     * @throws NoViewException
     * @throws \Exception
     */
    public function get($file, array $data = [], $ext = true)
    {
        $file = $this->getPath() . $file . ((true === $ext) ? $this->getExtension() : '');
        $this->exists($file);

        return $this->render($file, $data);
    }

    /**
     * @param string $file
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public function render($file, array $data = [])
    {
        $this->setVars($data);
        unset($data);
        ob_start();

        try {
            extract($this->vars);
            include $file;
        } catch (\Exception $e) {
            ob_clean();
            throw $e;
        }

        $content = ob_get_contents();
        ob_end_clean();
        // Return the contents
        return $content;
    }

    /**
     * @return View
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @param string $file
     * @param array $data
     * @return string
     * @throws NoViewException
     */
    public function __invoke($file, array $data = [])
    {
        return $this->get($file, $data);
    }

    /**
     * @param $key
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->vars[$key]);
    }

    /**
     * @param $key
     */
    public function __unset($key)
    {
        unset($this->vars[$key]);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->vars[$key];
    }

    /**
     * @param $var
     * @param $value
     */
    public function __set($var, $value)
    {
        $this->vars[$var] = $value;
    }


    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->vars);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->vars[$offset];
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->setVar($offset, $value);
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->vars[$offset]);
    }

    /**
     * @param string $file
     * @param array $data
     * @return mixed
     * @throws NoViewException
     */
    public function display($file, array $data = [])
    {
        echo $this->get($file, $data);
    }
}