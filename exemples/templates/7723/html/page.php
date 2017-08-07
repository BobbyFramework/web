<div class="container">

    <?php echo $page->getBreadcrumb()->render('Elements/breadcrumb');?>


    <?php foreach ($page->getRows() as $row) : ?>
        <?php if ($row->hasTitle()) : ?>
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        <?php echo $row->getTitle(); ?>
                    </h2>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php $nbCol = $row->countCols(); ?>
            <?php foreach ($row->getCols() as $col) : ?>
                <div class="col-margin col-md-<?php echo(12 / $nbCol); ?>">
                    <div <?php echo $color[array_rand($color, 1)]; ?> >
                        <?php echo $col->getContent(); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>