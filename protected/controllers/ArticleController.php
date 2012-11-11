<?php

class ArticleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main_1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    protected function beforeAction($action) {

        $action = $this->action->getId();

        $debug = 1;

        $basePath = Yii::getPathOfAlias('webroot.js');
        $baseUrlJs = Yii::app()->getAssetManager()->publish($basePath, true, -1, $debug);

        if (in_array($action, array('update')) ) {
            Yii::app()->clientScript->registerScriptFile($baseUrlJs . '/jquery.ajaxfileupload/ajaxfileupload.js', CClientScript::POS_BEGIN);
        }

        return true;
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CArticle;

        $parentId = Yii::app()->request->getParam('parent_id');
        $model->parent_id = $parentId;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CArticle']))
		{
			$model->attributes=$_POST['CArticle'];
			if($model->save()) {
				//$this->redirect(array('update','id'=>$model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

        //$subarticles = CArticle::model()->findAllByAttributes(array('parent_id' => $model->id));
        $subarticles = $model->subarticles;

        $returnUrl = Yii::app()->request->getParam('returnUrl');
        if ($model->isSubArticle()) {
            //$parent = CArticle::model()->findByPk($model->parent_id);
            $articleHeader = $model->parent->header;
        } else {
            $articleHeader = $model->header;
        }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CArticle']))
		{
			$model->attributes=$_POST['CArticle'];
			if($model->save() && $returnUrl)
				$this->redirect($returnUrl);
		}

        $code = $model->code;
        $activePage = '';
        if ($model->isSubArticle()) {
             $activePage = "/" . $model->code;
            $code = $model->parent->code;
        }

        $photos = CPhoto::model()->findAllByAttributes(array('article_id' => $id));
        $path = "/images/articles/{$code}{$activePage}/";


		$this->render('update',array(
			'model'=>$model,
            'articleHeader' => $articleHeader,
            'subarticles' => $subarticles,
            'path' => $path,
            'files' => $photos,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CArticle');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CArticle('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CArticle']))
			$model->attributes=$_GET['CArticle'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=CArticle::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='carticle-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
