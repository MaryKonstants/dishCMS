<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rick
 * Date: 23.01.12
 * Time: 15:17
 * To change this template use File | Settings | File Templates.
 */
class AttributesController extends AdminController{
	/**
	 * (non-PHPdoc)
	 * @see AdminController::filters()
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(), array(
			array('DModuleFilter', 'name'=>'shop')
		));
	}
	
    public function init()
    {
        //$this->_install();
    }

    public function getDbConnection(){
        return Yii::app()->db;
    }

    private function _install()
    {
        // create table
        $query = '
        CREATE TABLE IF NOT EXISTS `eav_attribute` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL,
          `type` smallint(6) NOT NULL,
          `fixed` tinyint(1) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

        CREATE TABLE IF NOT EXISTS `eav_value` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `id_attrs` int(11) NOT NULL,
          `id_product` int(11) NOT NULL,
          `value` varchar(255) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
        ';

        $this->getDbConnection()->createCommand($query)->execute();
    }

	public function actionIndex()
	{
		$attributes = EavAttribute::model()->findAll();

		$model=new EavAttribute('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Attributes']))
            $model->attributes=$_GET['Attributes'];

		$this->render('index', array('attributes'=>$attributes, 'model'=>$model));
	}

    public function actionAutocomplete()
    {
        $term = Yii::app()->getRequest()->getParam('term');
        if(Yii::app()->request->isAjaxRequest && $term) {

            $criteria = new CDbCriteria;
            $criteria->addSearchCondition('name', $term);
            $attributes = EavAttribute::model()->with('dictionary')->findAll($criteria);
            // обрабатываем результат
            $result = array();
            foreach($attributes as $attribute) {
                $single = $attribute->type == EavAttribute::SINGLE;
                $template = '<div class="row"><div class="col-xs-6">';
                $attr_id = 'attr_' . $attribute->id;
                if (!count($attribute->dictionary)) {
                    $template .= CHtml::label($attribute->name, $attr_id);
                    $template .= CHtml::textField('EavValue['. $attribute->id .']', '', ['id' => $attr_id]);
                } else {
                    $data = [];
                    foreach ($attribute->dictionary as $item) {
                        $data[$item->value] = $item->value;
                    }
                    $multiple = $single ? '' : 'multiple=\'multiple\'';
                    $template .= CHtml::label($attribute->name, $attr_id);
                    $options = ['id' => $attr_id, 'class' => 'attr-select'];
                     if (!$single) $options['multiple'] = 'multiple';
                    $template .= CHtml::dropDownList('EavValue['. $attribute->id .']', null, $data, $options);
                }
                $template .= '</div><div class="col-xs-6">';
                $template .= '<span id="Remove<?= $pAttr?>" data-id="'. $attribute->id .'" data-id_product="idProduct" class="glyphicon glyphicon-remove btn-remove" title="Удалить"></span>';
                $template .= '</div>';

                $result[] = array('id'=>$attribute['id'], 'value'=>$attribute['name'], 'template' => $template);
            }
            echo CJSON::encode($result);
            Yii::app()->end();
        }
    }
	public function actionAdd()
	{
		$model=new EavAttribute;
        $model->type = EavAttribute::SINGLE;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['EavAttribute']))
        {
            $model->attributes=$_POST['EavAttribute'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('add',array(
            'model'=>$model,
        ));
	}

	public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['EavAttribute'])) {
            $model->attributes = $_POST['EavAttribute'];
            if ($model->save()) {
                $oldDictionaryArr = [];
                $oldDictionary = EavDictionary::model()->findAll('id_attrs=:id_attrs', ['id_attrs' => $model->id]);
                foreach ($oldDictionary as $element) {
                    $oldDictionaryArr[$element->id] = $element;
                }
                if ($dictionary = Yii::app()->request->getPost('EavDictionary')) {
                    foreach ($dictionary as $key => $value) {

                        if (isset($oldDictionaryArr[$key])) {
                            if ($oldDictionaryArr[$key]->value != $value['val'] || $oldDictionaryArr[$key]->property != $value['prop']) {
                                $oldDictionaryArr[$key]->value = $value['val'];
                                $oldDictionaryArr[$key]->property = $value['prop'];
                                $oldDictionaryArr[$key]->save();
                            }
                            unset($oldDictionaryArr[$key]);
                        } else {

                            if ($value['val']) {
                                $attrDictionary = new EavDictionary;
                                $attrDictionary->id_attrs = $model->id;
                                $attrDictionary->value = $value['val'];
                                $attrDictionary->property = $value['prop'];
                                $attrDictionary->save();
                            }
                        }
                    }
                }
                foreach ($oldDictionaryArr as $oldDictionary) {
                    $oldDictionary->delete();
                }
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function loadModel($id)
    {
        $model=EavAttribute::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='attributes-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}