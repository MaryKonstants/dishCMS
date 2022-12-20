<?php
/** @var \iblock\models\InfoBlock $iblock */
use iblock\components\InfoBlockHelper;
?>
<?php if($data=InfoBlockHelper::getElements($iblock->id)): ?>
    <h2><?= $iblock->title; ?></h2>
    <div class="iblock__description">
        <?php echo $iblock->description; ?>
    </div>
    <div class="iblock__list">
	<?php foreach($data as $item): ?>
		<div class="iblock__item">
			<div class="iblock__item-preview"><?= $item['preview'] ? CHtml::image($item['preview']) : '&nbsp;'; ?></div>
			<div class="iblock__item-title"><?php 
			if($item['description']): 
				?><?= CHtml::link($item['title'], ['infoblock/view', 'id'=>$item['id']]); ?><?php
			else: 
				?><?= $item['title']; ?><?php 
			endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>
