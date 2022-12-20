<?php
$prefix = SUBDOMAIN;
if(D_MODE_LOCAL){
    $prefix = 'local.';
}

return CMap::mergeArray(
	require(dirname(__FILE__).'/defaults.php'),
	array(
		'components'=>array(
			'db'=>include(dirname(__FILE__)."/{$prefix}db.php"),
		),
//        'theme'=>'my',
        //'theme'=>'template_flex',
        //'theme'=>'adaptive_template_4',
	)
);
