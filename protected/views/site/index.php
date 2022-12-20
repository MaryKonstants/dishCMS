<?php if (D::yd()->isActive('slider')): ?>
<?php $this->widget('\extend\modules\slider\widgets\Slider', ['code'=>'main', 'content'=>function($slides) { ?>
        <section class="slider">
            <div class="slider__main slider__container">
                <?php foreach ($slides as $slide):?>
                <div class="slider__main-item">
                    <?php if ($slide->url): ?>
                        <a href="<?= $slide->url ?>" class="slider__item">
                    <?php endif; ?>
                        <div class="slider__img" style="background-image:url(<?= $slide->src ?>)"
                             alt="<?= $slide->alt ?>" title="<?= $slide->alt ?>">
                            <?php if ($slide->title || $slide->alt): ?>
                                <div class="slider__bg"></div>
                                <div class="slider__item-textbox">
                                    <?php if ($slide->title): ?>
                                        <div class="slider__item-header"><?= $slide->title ?></div>
                                    <?php endif; ?>
                                    <? if ($slide->alt): ?>
                                        <div class="slider__item-desc"><?= $slide->alt ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php if ($slide->url): ?></a><?php endif; ?>
                </div>
            <? endforeach; ?>
            </div>
        </section>
<?php }, 'cache'=>false, 'options'=>[
        'dots' => true,
        'infinite' => true,
        'autoplay' => false,
]]); ?>
<?php else: ?>
<div class="banner">
    <div class="banner__slider">
        <div class="banner__item banner__item-wide">
            <div class="banner__img" style="background-image: url('/images/banner.png');"></div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="page-content">
    <div class="page-content__container container">
        <? \crud\models\ar\Service::widget(); ?>
        <?= $page->text ?>
    </div>
</div>

<?php if ((D::cms('hide_news') == false) && !D::cms('vertical_template')): ?>
    <?php $this->widget('widget.Events.Events') ?>
<? endif ?>
