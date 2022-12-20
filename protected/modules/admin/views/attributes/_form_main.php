<div class="row">
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name'); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'type'); ?>
    <?php echo $form->radioButtonList($model,'type',
        [1 => 'Еденичный', 2 => 'Множественный'],
        ["labelOptions"=>['class' => 'inline']]
    );
    ?>
    <?php echo $form->error($model,'type'); ?>
</div>

<div class="row">
    <?php echo $form->checkBox($model, 'fixed'); ?>
    <?php echo $form->labelEx($model, 'fixed', array('class' => 'inline')); ?>
    <?php echo $form->error($model, 'fixed'); ?>
</div>

<div class="row">
    <?php echo $form->checkBox($model, 'filter'); ?>
    <?php echo $form->labelEx($model, 'filter', array('class' => 'inline')); ?>
    <?php echo $form->error($model, 'filter'); ?>
</div>