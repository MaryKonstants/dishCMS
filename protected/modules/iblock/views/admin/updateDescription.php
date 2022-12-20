<?php
/* @var $this iblock\controllers\AdminController */
/* @var $model iblock\models\InfoBlock */
/* @var $form CActiveForm */
?>

<h1>Изменение инфо-блока #<?php echo $model->id; ?></h1>


<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'info-block-form',
        'enableAjaxValidation'=>false,
    )); ?>


    <?php echo $form->errorSummary($model); ?>
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
    <div class="row buttons">
        <div class="left">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class'=>'btn btn-primary')); ?>
        </div>
        <div class="clr"></div>

    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->