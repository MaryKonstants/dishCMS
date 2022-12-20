<?php
/**
 * DB connection config
 */
return array(
    'connectionString' => 'mysql:host=localhost;dbname=new-grid',
    'username' => 'db_username',
    'password' => 'db_password',
//    'schemaCachingDuration' => 1000,
	'initSQLs'=>[
		"SET sql_mode=''",
		// "SET time_zone = '+7:00'"
	]
);
