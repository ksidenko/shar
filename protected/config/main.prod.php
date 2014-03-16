<?php
return CMap::mergeArray(
    require_once('main.php'),
    array(
        'components'=>array(
            'db'=>array(
                'connectionString' => 'mysql:host=shar.mysql;dbname=shar_db',
                'username' => 'shar_mysql',
                'password' => 'uxu8s2hm',
                'enableProfiling' => 0,
                'enableParamLogging' => 0,
            ),
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        //'levels'=>'error, warning',
                        'enabled' => false,
                    ),
                    array(
                        'class'=>'CWebLogRoute',
                        //'levels'=>'error, warning',
                        'enabled' => false,
                    ),
                ),
            ),
            'errorHandler'=>array(
                'errorAction'=>'/page/main',
            ),
            'assetManager'=>array(
                'basePath' => '/home/shar/tmp',
            ),
        )
    )
);