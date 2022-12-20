<div class="form">
    <? $this->breadcrumbs = array(
        'Атрибуты товара'=>array('attributes/index'),
        $model->isNewRecord ? 'Создание атрибута' : 'Редактирование атрибута'
    );?>



    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'attributes-12-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation' => false,
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php
    $tabs = array(
        'Основное' => array('content' => $this->renderPartial('_form_main', compact('model', 'form'), true), 'id' => 'tab-main'),
        //'Словарь' => array('content' => $this->renderPartial('_form_dictionary', compact('model', 'form'), true), 'id' => 'tab-dictionary'),
    );

    if (!$model->isNewRecord)
        $tabs['Словарь'] = array('content' => $this->renderPartial('_form_dictionary', compact('model', 'form'), true), 'id' => 'tab-dictionary');

    $this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs' => $tabs,
        'options' => array()
    )); ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'default-button')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->