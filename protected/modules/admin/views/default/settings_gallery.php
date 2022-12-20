<?if(D::yd()->isActive('gallery') && D::role('sadmin')):?>
<div class="row">
    <?php echo $form->labelEx($model, 'gallery_title'); ?>
    <?php echo $form->textField($model, 'gallery_title', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'gallery_title'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'gallery_on_page'); ?>
    <?php echo $form->textField($model, 'gallery_on_page', array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'gallery_on_page'); ?>
</div>
<?endif?>