<html>
<head>
    <?php $template->display("partials/css"); ?>
</head>
<body>
<?php echo $template->getPartial('header_1'); ?>
<?php echo $template->getPartial('nav'); ?>
<?php echo $template->getContent(); ?>

<?php echo $template->getPartial('footer_1'); ?>

<?php echo $page->getAssets()->outputJs();?>
</body>
</html>
