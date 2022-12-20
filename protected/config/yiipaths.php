<?php
$webroot = realpath(dirname(__FILE__, 2));
return [
	$webroot . '/../yii',
	$webroot . '/../../yii',
	$webroot . '/../yii/framework',
	$webroot . '/../../yii/framework',
	$webroot . '/protected/vendor/yii',
	$webroot . '/protected/vendor/yii/framework',
];