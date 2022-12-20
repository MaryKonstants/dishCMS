<?php
use common\components\helpers\HArray as A;
/** @var array $data */
$url = \Yii::app()->createUrl($data['url'], ['id'=>$data['id']]);
$idx = ($index + 1) + $dataProvider->pagination->currentPage * $dataProvider->pagination->pageSize;

?>

<div class="search-result__item">
    <div class="search__number"><?= $idx ?></div>
    <div class="search__content">
        <div class="search__title"><?php echo CHtml::link($data['title'], $url); ?></div>
        <div class="search__text"><?= strip_tags($data['text']); ?></div>
    </div>
</div>