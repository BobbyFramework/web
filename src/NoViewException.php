<?php

namespace BobbyFramework\Web;

/**
 * Class View
 *
 * @package BobbyFramework\Web
 */
class NoViewException extends \Exception
{
    /**
     * @var string $noView
     */
    protected $noView;

    /**
     * NoViewException constructor.
     *
     * @param string          $noView
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct($noView, $message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setNoFile($noView);
    }

    /**
     * @param string $noView
     */
    public function setNoFile($noView)
    {
        $this->noView = $noView;
    }

    /**
     * @return string
     */
    public function getNoFile()
    {
        return $this->noView;
    }
}
