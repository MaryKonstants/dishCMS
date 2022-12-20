<?php $this->beginContent('//layouts/main'); ?>

<div class="page-content">
    <div class="page-content__container container">
        <?php if (D::cms('treemenu_show_breadcrumbs')):
            $this->widget('\ext\D\breadcrumbs\widgets\Breadcrumbs', array('breadcrumbs' => $this->breadcrumbs->get()));
        endif;
        ?>

        <?= $content ?>
    </div>
</div>

<?php $this->endContent(); ?>

