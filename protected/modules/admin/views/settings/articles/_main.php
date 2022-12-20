<?
use common\components\helpers\HArray as A;

if(D::isDevMode()) {
    $this->widget('\common\widgets\form\NumberField', A::m(compact('form', 'model'), [
        'attribute' => 'quantity_on_page',
    ]));
}
