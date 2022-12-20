<?php
/**
 * Конфигуарция поиска
 */
return [
    'queryname' => 'q',
    'minlength' => 3,
    'maxTextLength' => 200,
    'throughSearch' => false,
    'autocomplete' => [
    	'mark'=>true,
        'limit' => 20,
        'models' => [
            '\Product' => [
                'attributes' => ['code', 'title', 'description'],
                'criteria' => ['select'=>'id, code, title', 'scopes'=>'visibled'],
                'titleAttribute' => function($model) {
	                $title=$model->code ? "({$model->code}) {$model->title}" : $model->title;
					return \CHtml::link($model->title, ['/shop/product', 'id'=>$model->id]);
                }
            ],
        ]
    ],
    'search' => [
        'models' => [
			'\Product' => [
                'title' => 'Товары',
                'attributes' => ['title', 'description', 'code'],
                'criteria' => ['scopes'=>['cardColumns', 'visibled']],
				// 'strong_relevance_multiplier'=>4,
                'limit'=>42,
                'item' => [
                    'url' => function ($model) {
                        return \Yii::app()->createUrl('/shop/product', ['id'=>$model->id]);
                    }
                ],
				'wrapperOpen'=>'<div id="product-list-module">',
				'wrapperClose'=>'</div>',
				'listView'=>[
					'emptyText'=>'<div class="category-empty">Нет товаров для отображения.</div>',
					'itemView'=>'/shop/_products',
					'itemsCssClass'=>'t3__adaptive-product__list product-list row',
					'sortableAttributes'=>['title', 'price'],
					'template'=>'{sorter}{items}{pager}'
				]
            ],
            '\Event' => [
                'title' => 'Новости',
                'summaryTitle' => 'Новостей',
                'attributes' => ['title', 'text'],
                'criteria' => ['select'=>'id, title, intro'],
                'limit'=>3,
                'item' => [
                    'url' => function ($model) {
                        return \Yii::app()->createUrl('/site/event', ['id'=>$model->id]);
                    }
                ]
            ],
            '\Page' => [
                'title' => 'Страницы',
                'summaryTitle' => 'Страниц',
                'attributes' => ['title', 'text'],
                'criteria' => ['select'=>'id, title, intro'],
                'limit'=>3,
                'item' => [
                    'url' => function ($model) {
                        return \Yii::app()->createUrl('/site/page', ['id'=>$model->id]);
                    }
                ]
            ],
            '\crud\models\ar\Service' => [
                'title' => 'Устуги',
                'summaryTitle' => 'Страниц',
                'attributes' => ['title', 'text'],
                'criteria' => ['select'=>'id, title, preview_text'],
                'limit'=>3,
                'item' => [
                    'introAttribute' => 'preview_text',
                    'url' => function ($model) {
                        return \Yii::app()->createUrl('/services/view', ['id'=>$model->id]);
                    }
                ]
            ],
            '\Sale' => [
                'title' => 'Продукция',
                'summaryTitle' => 'Страниц',
                'attributes' => ['title', 'text'],
                'criteria' => ['select'=>'id, title, preview_text'],
                'limit'=>3,
                'item' => [
                    'introAttribute' => 'preview_text',
                    'url' => function ($model) {
                        return \Yii::app()->createUrl('/sale/view', ['id'=>$model->id]);
                    }
                ]
            ],
        ]
    ],
    'through' => [
        "product" => [
            'shortcut' => 'p',
            "as" => [
                "p.id as id",
                "p.title as title",
                "p.description as text",
                "p.code as code",
                "'/shop/product' as url",
                "'Product' as model",
            ]
        ],
        "event" => [
            'shortcut' => 'e',
            "as" => [
                "e.id as id",
                "e.title as title",
                "e.text as text",
                "null as code",
                "'/site/event' as url",
                "'Event' as model",
            ]
        ],
        "page" => [
            'shortcut' => 'pg',
            "as" => [
                "pg.id as id",
                "pg.title as title",
                "pg.text as text",
                "null as code",
                "'/site/page' as url",
                "'Page' as model",
            ]
        ],
    ]
];
