<ol class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) : ?>
        <li>
            <a href="#" class="<?php echo (true === $breadcrumb['active']) ? 'active' : '' ;?>" >
                <?php echo $breadcrumb['content'] ;?>
            </a>
        </li>
    <?php endforeach; ?>
</ol>