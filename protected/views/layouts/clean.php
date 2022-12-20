<? $this->beginContent('//layouts/main') ?>

    <div class="container">
        <?php if (D::cms('treemenu_show_breadcrumbs')):
            $this->widget('\ext\D\breadcrumbs\widgets\Breadcrumbs', array('breadcrumbs' => $this->breadcrumbs->get()));
        endif;
        ?>
        <article id="content" class="content">
            <?= $content ?>
        </article>
    </div>

<? $this->endContent() ?>