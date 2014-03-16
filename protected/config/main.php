<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Студия дизайна Шар',

    'language' =>'ru',

	// preloading 'log' component
	'preload' => array('log', 'ELangHandler'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.widgets.*',
        'application.helpers.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
            'loginUrl' => array('login'),
		),
		// uncomment the following to enable URLs in path-format

        'ELangHandler' => array (
            'class' => 'application.extensions.langhandler.ELangHandler',
            'strict' => true,
            'languages' => array('ru','en'),
        ),

		'urlManager'=>array(
            'class'=>'application.extensions.langhandler.ELangCUrlManager',
			'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
                'login' => '/site/login',
                'logout' => '/site/logout',

			    '/*' => 'page/index',
                '/main/*' => '/page/main',

                '/flat/*' => '/page/intererAlbum/type/flat',
                '/house/*' => '/page/intererAlbum/type/house',
                '/society/*' => '/page/intererAlbum/type/society',

//                '/flat1/*' => '/page/intererAlbum/type/flat',
//                '/house1/*' => '/page/intererAlbum/type/house',
//                '/society1/*' => '/page/intererAlbum/type/society',

                '/sign/*' => '/page/graph/type/sign',
                '/corp_style/*' => '/page/graph/type/corp_style',
                '/graph/*' => '/page/graph/type/graph',

                '/price/*' => '/page/price',
                '/contacts/*' => '/page/contacts',
                '/partners/*' => '/page/partners',
		
		'<controller:\w+>/<action:\w+>/*' => '<controller>/<action>',
//				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
//				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

			),
		),
        'clientScript'=>array(
            'packages'=>array(
                'jquery'=>array(
                    'baseUrl'=>'/js/',
                    'js'=>array('jquery-1.11.0.min.js'),
                )
            ),
        ),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=shar_db',
			'emulatePrepare' => true,
			'username' => 'shar',
			'password' => '1',
			'charset' => 'utf8',
            'enableProfiling' => YII_DEBUG,
            'enableParamLogging' => YII_DEBUG,
		),
		'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				array(
					'class'=>'CWebLogRoute',
                    'levels'=>'error, warning',
				),
			),
		),
        'assetManager'=>array(
            'basePath' => '/home/shar/tmp',
        ),
	),

	'params'=>array(
		'adminEmail' => 'webmaster@example.com',
        'image_path' => dirname(__FILE__) . '/../../images/articles/',
        'image_render_max_execution_time' => 60 * 60 ,
        'image_url' => '',
        'hash_css' => '2022014_2',
	),
);