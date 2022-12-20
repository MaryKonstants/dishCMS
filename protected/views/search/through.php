<?php
use common\components\helpers\HArray as A;
$from = $dataProvider->pagination->currentPage * $dataProvider->pagination->pageSize + 1;
$to = $from + $dataProvider->pagination->pageSize - 1;
?>
<h1>Поиск</h1>
<? $this->widget('widget.search.SearchWidget', ['submit'=>'', 'view'=>'search_form_on_page']); ?>
<div class="search__block">
<?php

$isEmpty = !$dataProvider->totalItemCount;
$this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemsCssClass'=>'search-result__items',
    'itemView' => '//search/_item_raw_search',
    'pagerCssClass'=>'pager search-pager',
    'viewData' => ['dataProvider' => $dataProvider],
    'summaryText' => "Результатов: {start} &mdash; {end} из {count}",
    'summaryTagName' => 'div',
    'summaryCssClass' => 'search__info',
    'pager'=>[
        'class' => 'DLinkPager',
        'maxButtonCount'=>'5',
        'header'=>'',
        'firstPageLabel' => '<<',
        'prevPageLabel' => '<',
        'nextPageLabel' => '>',
        'lastPageLabel' => '>>',
    ],
    'template' => '{summary}{items}{pager}',
]);
?>
</div>
<?php if($isEmpty): ?>
<div class="search__result-is-empty">По вашему запросу ничего не найдено</div>
<?php endif; ?>
