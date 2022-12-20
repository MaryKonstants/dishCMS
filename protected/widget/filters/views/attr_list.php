<?php
    if(Yii::app()->controller->action->id == 'category') {
        $actionURL = '/' . Yii::app()->request->getPathInfo();
    }
    elseif(Yii::app()->controller->action->id == 'product') {
        $actionURL = Yii::app()->createUrl('/shop/category', ['id'=>$this->categoryId]);
    }
    else {
        $actionURL = '/shop/filter';
    }
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'page-form',
)); ?>

<?php echo CHtml::textField('price_from'); ?>
<?php echo CHtml::textField('price_to'); ?>

<div class="filter">
	<div id="slider-range"></div>
</div>
<?php $this->endWidget(); ?>
<?php 
	$current_price_min = $min_price;
	$current_price_max = $max_price;
?>

<script>
	$(document).ready(function(){
		$('.reset-filter').on('click', function(){
			$("select").each(function() { $(this).val('none'); });
			$('#price_from').val('<?php echo $current_price_min; ?>');
			$('#price_to').val('<?php echo $current_price_max; ?>');
			$( "#slider-range" ).slider( "values", 1, <?php echo $current_price_max; ?>, $( "#slider-range" ).slider( "values", 0, 0 ));
			
			$('#form-filter').submit();
		});
	});


	var x;
	var y;
	$('.right-side').mousemove(function(e) {
	          x = e.pageX;
	          y = e.pageY;
	});
	if(parseInt(<?php echo $current_price_max; ?>)==0){
		$('.filter').hide();
	}
	$("#slider-range").slider({
	    range: true,
	    min: <?php echo $min_price; ?>,
	    max: <?php echo $max_price; ?>,
	    values: [<?php echo $current_price_min; ?>,<?php echo $current_price_max; ?>],
	    animate: true,
	    click: function(){
	    	$('input.shop-button').hide();	
	    },
	    change: function(){
	    	//$('#page-form').submit();
	    	//$('.filter_this').css('top', y)
	    	
	    	$('.filter_this').css('left', x);
	    	$('input.shop-button').show();
	    },
	    slide: function( event, ui ) {
	       if(ui.values[1] - ui.values[0] < 1 ) return false;
		       $('#price_from').val(ui.values[0]);
		       $('#price_to').val(ui.values[1]);
	        }
	    });
	 $( "#price_from" ).val( $( "#slider-range" ).slider( "values", 0 ));
	 $( "#price_to" ).val( $( "#slider-range" ).slider( "values", 1 ));
</script>

<?php
$form = $this->beginWidget('CActiveForm', [
    'id' => 'form-filter',
    'method' => 'get',
    'action' => $actionURL,
    ]);
foreach ($attributes as $key => $attr):  ?>
        <div class="filter__block">
            <div class="filter__header active">
                <span><?php echo $attr['name']; ?></span>
                <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 1L8 8L1 1" stroke="#7E7E7E" stroke-width="1.5" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="filter__main open">
                <?php foreach ($attr['values'] as $value): ?>
                    <div class="inputs_wrapper">
                        <?php echo CHtml::checkBox($key, false, ['value' => $value]); ?>
                        <label for="<?= $attr['name'] ?>"><?= CHtml::tag('div', ['data-id' => $key], $value) ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
<?php endforeach; ?>


<?php echo CHtml::button('Сбросить', array('class'=>'reset-filter')); ?>

<?php echo CHtml::submitButton('фильтровать', array('class'=>'filter-button')); ?>
<?php $this->endWidget(); ?>
