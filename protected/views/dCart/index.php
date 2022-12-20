<?if(\Yii::app()->cart->isEmpty()):?>
	Ваша корзина пуста.
<?else:?>
	<h1>Корзина</h1>
	<?$this->widget('\DCart\widgets\ModalCartWidget', array('hidePayButton'=>true))?>
<?endif?>	