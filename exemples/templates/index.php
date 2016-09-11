<?php


define('APP_PATH', realpath('../..'));

require APP_PATH . '/vendor/autoload.php';

$view = new \BobbyFramework\Web\Template();
$view->setPath(APP_PATH . '/exemples/templates/7723/html/');

$page = new \BobbyFramework\Web\Managers\Page();
//ADD detail Page
$page->setTitle('titre d ela page');
$page->setMetaDescription('dghsjdshghdgd');

//ADD assets page
$assets = new \BobbyFramework\Web\Components\Assets();
$assets->addCss([
    'href' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
    'media' => 'all',
    'integrity' => "sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7",
    'crossorigin' => "anonymous"
]);
$assets->addCss([
    'href' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css',
    'media' => 'all',
    'integrity' => "sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r",
    'crossorigin' => "anonymous"
]);

$assets->addJs([
    'src' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
    'integrity' => "sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS",
    'crossorigin' => "anonymous"
]);

$breadcrumb = new \BobbyFramework\Web\Components\Breadcrumb($view);
$breadcrumb->add('page');
$breadcrumb->add('dsdsd');
$breadcrumb->active('dsdsd');
$page->setBreadcrumb($breadcrumb);

$page->setAssets($assets);

//ADD ROW CONTENT
$row = new \BobbyFramework\Web\Components\Row();
$row->setTitle('Titre du paragraphe');

$col = new \BobbyFramework\Web\Components\Col();
$col->setContent("sdsd");
$row->addCols($col);

$col = new \BobbyFramework\Web\Components\Col();
$col->setContent("sddsqsdqsdsd");
$row->addCols($col);

$page->addRow($row);


//ADD ROW CONTENT
$row = new \BobbyFramework\Web\Components\Row();
$row->setTitle('Titre du paragraphe');

$col = new \BobbyFramework\Web\Components\Col();
$col->setContent("sdsd");
$row->addCols($col);

$col = new \BobbyFramework\Web\Components\Col();
$col->setContent("sddsqsdqsdsd");
$row->addCols($col);

$page->addRow($row);


//ADD ROW CONTENT
$row = new \BobbyFramework\Web\Components\Row();
$row->setTitle('Titre du paragraphe');

$col = new \BobbyFramework\Web\Components\Col();
$col->setContent("sdsd");
$row->addCols($col);

$col = new \BobbyFramework\Web\Components\Col();
$col->setContent("sddsqsdqsdsd");
$row->addCols($col);

$page->addRow($row);


//ADD ROW CONTENT
$row = new \BobbyFramework\Web\Components\Row();
$row->setTitle('Titre du paragraphe');

$col = new \BobbyFramework\Web\Components\Col();
$col->setContent("sdsd");
$row->addCols($col);

$col = new \BobbyFramework\Web\Components\Col();
$col->setContent("sddsqsdqsdsd");
$row->addCols($col);

$page->addRow($row);

$row = new \BobbyFramework\Web\Components\Row();

$col = new \BobbyFramework\Web\Components\Col();
$col->setContent('dsdsdsd');
$row->addCols($col);

$col = new \BobbyFramework\Web\Components\Col();

$slider = new \BobbyFramework\Web\Components\Slider\Slider($view);

$slide = new \BobbyFramework\Web\Components\Slider\Slide();
$slide->setHref('jkdsdd');
$slide->setImage('dsdsds');
$slide->setImageThumbnail('sds');
$slider->add($slide);

$slide->setHref('jkdsdd');
$slide->setImage('dsdsds');
$slide->setImageThumbnail('sds');
$slider->add($slide);

$slide->setHref('jkdsdd');
$slide->setImage('dsdsds');
$slide->setImageThumbnail('sds');
$slider->add($slide);

$col->setContent($slider->render());
$row->addCols($col);

$col = new \BobbyFramework\Web\Components\Col();
$col->setContent("sdsd sdsqdsqqd");
$row->addCols($col);

$page->addRow($row);


//INITIALIZE TEMPLATE/VIEW


//set layout
$view->layout("layouts/layout");
//set partials
$view->setPartial('nav', 'partials/nav');
$view->setPartial('header_1', 'partials/header/header_1');
$view->setPartial('footer_1', 'partials/footer/footer_1');

//set vAR
$view->setVar('color', [
    'style="background:red;"',
    'style="background:blue;"',
    'style="background:green;"'
]);
$view->setVar('page', $page);

//set content
$view->setContent('page');

echo $view->render();

