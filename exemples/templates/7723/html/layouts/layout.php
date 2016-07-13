<html>
<head>
    <?php $view->displayView("partials/css"); ?>
</head>
<body>
<?php echo $view->getPartial('header_1'); ?>
<?php echo $view->getPartial('nav'); ?>
<?php echo $view->getContent(); ?>

<?php echo $view->getPartial('footer_1'); ?>

<?php echo $page->getAssets()->outputJs();?>
</body>
</html>
