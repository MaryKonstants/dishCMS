<?php
/* @var $this iblock\controllers\AdminController */
/* @var $model iblock\models\InfoBlock */
/* @var $form CActiveForm */
?>

<div class="row">
    <?php echo $form->checkBox($model, 'active'); ?>
    <?php echo $form->labelEx($model, 'active', ['class' => 'inline']); ?>
    <?php echo $form->error($model, 'active'); ?>
</div>
<div class="row">
    <?php echo $form->checkBox($model, 'use_preview'); ?>
    <?php echo $form->labelEx($model, 'use_preview', ['class' => 'inline']); ?>
    <?php echo $form->error($model, 'use_preview'); ?>
</div>
<div class="row">
    <?php echo $form->checkBox($model, 'use_description'); ?>
    <?php echo $form->labelEx($model, 'use_description', ['class' => 'inline']); ?>
    <?php echo $form->error($model, 'use_description'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'title'); ?>
    <?php echo $form->textField($model, 'title', array('class' => 'form-control')); ?>
    <?php echo $form->error($model, 'title'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'description'); ?>
    <?php $this->widget('admin.widget.EditWidget.TinyMCE', array(
        'model'=>$model,
        'attribute'=>'description',
        'htmlOptions'=>array('class'=>'big')
    )); ?>
    <?php echo $form->error($model, 'description'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'code'); ?>
    <?php echo $form->textField($model, 'code', array('class' => 'form-control')); ?>
    <?php echo $form->error($model, 'code'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'sort'); ?>
    <?php echo $form->textField($model, 'sort', array('class' => 'form-control')); ?>
    <?php echo $form->error($model, 'sort'); ?>
</div>
