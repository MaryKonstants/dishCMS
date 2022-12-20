<script type="text/javascript">
    $(document).ready(function () {
        window.attributes = [];

        <?php if(!$model->isNewRecord):?>
        <?php $productAttributes = $model->productAttributes; foreach ($productAttributes as $productAttribute):?>
        window.attributes.push(<?php echo "'" . $productAttribute->eavAttribute['name'] . "'";?>);
        <?php endforeach;?>
        <?php else:?>
        <?php foreach ($fixAttributes as $fixAttribute):?>
        window.attributes.push(<?php echo "'" . $fixAttribute['name'] . "'";?>);
        <?php endforeach;?>
        <?php endif;?>

    });
</script>
<div class="row">
    <label>Введите название атрибута</label>
    <?php
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model' => EavAttribute::model(), // модель
        'attribute' => 'name', // атрибут модели
        'name' => 'searchAttribute',
        'id' => 'searchAttribute',
        'source' => $this->createUrl('attributes/autocomplete'),
        // additional javascript options for the autocomplete plugin
        'options' => array(
            'minLength' => '2',
            'select' => "js:function(event, ui) {
	        	if(jQuery.inArray( ui.item.value, window.attributes ) == -1){
	        		window.attributes.push(ui.item.value);
	        		$('#attributes').append(ui.item.template.replaceAll('idProduct', " . $model->id . "));
	        		$('.attr-select').select2();
	        	}

	        	$('#searchAttribute').val('');
	        	return false;
	        }",
        ),
        'htmlOptions' => array(
            'class' => 'form-control'
        ),
    ));
    ?>
</div>
<hr>
<br>
<div id="attributes">
    <?php
    foreach ($productAttrs as $pAttr => $value) { ?>
        <div class="row">
            <div class="col-xs-6">
            <?php
            $single = $eavAttributes[$pAttr]->type == EavAttribute::SINGLE;
            $attr_id = 'attr_' . $pAttr;
            $options = ['id' => $attr_id, 'class' => 'attr-select', 'style' => 'width:100%;'];
            $name = 'EavValue[' . $pAttr . ']';
            echo CHtml::label($eavAttributes[$pAttr]->name, $attr_id);
            if (!count($eavAttributes[$pAttr]->dictionary)):
                $options['class'] = 'attr-input';
                $val = is_array($value) ? $value[0] : $value;
                echo CHtml::textField($name, $val, $options);
            else:
                if (!$single) {
                    $options['multiple'] = 'multiple';
                    $name .= '[]';
                }
                $data = [];
                foreach ($eavAttributes[$pAttr]->dictionary as $item) {
                    $data[$item->value] = $item->value;
                }
                echo CHtml::dropDownList($name, $value, $data, $options);
            endif; ?>
            </div>
            <div class="col-xs-6">
                <span id="Remove<?= $pAttr?>" data-id="<?= $pAttr?>" data-id_product="<?= $model->id ?>" class="glyphicon glyphicon-remove btn-remove" title="Удалить"></span>
            </div>
        </div>
    <?php } ?>
</div>


<script>
    $(document).ready(function () {
        $('.attr-select').select2();
        $('body').on('click', '#attributes .btn-remove', function (e) {
            var self = $(this);
            if (confirm('Вы уверены что хотите удалить данный атрибут у товара?')) {
                var url = '<?php echo $this->createUrl('shop/removeProductAttribute') ?>';
                $.post(url , {id_attrs: $(this).data('id'), id_product: $(this).data('id_product')})
                    .done(function (data) {
                        $(self).closest('.row').remove();
                    })
            }
        })
    });
</script>