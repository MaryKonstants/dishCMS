<div class="news">
    <div class="news__container container">
        <div class="news__inner">
            <div class="news__header">
                <h2 class="news__title"><?= D::cms('events_title')?></h2>
                <?php if (!D::cms('vertical_template')): ?>
                    <div class="news-all">
                        <a class="news-all__link" href="<?= \Yii::app()->createUrl('site/events') ?>"><?= D::cms('events_link_all_text')?></a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="news__list">
                <?php foreach($events as $event): ?>
                    <?$this->controller->renderPartial('//site/_events_item', ['data'=>$event])?>
                <?php endforeach; ?>
            </div>

            <div class="news-all news-all--mobile">
                <a class="news-all__link" href="<?= \Yii::app()->createUrl('site/events') ?>"><?= D::cms('events_link_all_text')?></a>
            </div>
        </div>
    </div>
</div>
