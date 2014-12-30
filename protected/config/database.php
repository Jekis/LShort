<?php

// This is the database connection configuration.
return array(
//	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
    'connectionString' => 'mysql:host=localhost;dbname=lshort',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
);
