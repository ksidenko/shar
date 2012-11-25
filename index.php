<?php
//phpinfo();die;

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'local'));

//echo APPLICATION_ENV; die;

// change the following paths if necessary
$yii=dirname(__FILE__).'/lib/yii.php';
if (APPLICATION_ENV == 'production') {
    $config=dirname(__FILE__).'/protected/config/main.prod.php';
} else {
    // remove the following lines when in production mode
    defined('YII_DEBUG') or define('YII_DEBUG',1);
    // specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

    $config=dirname(__FILE__).'/protected/config/main.php';
}

require_once($yii);
Yii::createWebApplication($config)->run();
