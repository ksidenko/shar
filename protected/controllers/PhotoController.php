<?php

class PhotoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
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
		$model=new CPhoto;
        $result = array('error' => '', 'msg' => '');
		if (isset($_REQUEST['CPhoto'])) {
			$model->attributes=$_REQUEST['CPhoto'];
            $model->path=CUploadedFile::getInstance($model,'path');

            $transaction=$model->dbConnection->beginTransaction();
			if ($model->save()) {

                $imagePath = $model->getImagePath();
                $fileName_ = Helpers::tempFileName(YiiBase::getPathOfAlias('application') . '/..' . $imagePath, '');
                $fileName = $fileName_ . '.' . $model->path->getExtensionName();
                $folder = YiiBase::getPathOfAlias('application') . '/..' . $imagePath ;

                $result['msg'] .= $folder . $fileName;
                $model->path->saveAs($folder . $fileName);

                $article = $model->article;
                if ($article->isSubArticle()) {
                    $article = $article->parent;
                }

                Helpers::imageresize($folder . '/big/' . $fileName, $folder . $fileName, $article->img_big_h, 1111, 90, array('fix_h' => true));
                Helpers::imageresize($folder . '/thumbs/' . $fileName, $folder . $fileName, $article->img_thumb_h, 1111, 90, array('fix_h' => true));

                $model->path = $fileName;
                $model->save();

                @unlink($folder . '/' . $fileName_);

                $li = Helpers::renderImageBlock ($imagePath, $fileName, $model->id);
                $transaction->commit();
                $result['html'] = urlencode($li);
            } else {
                $result['error'] = $model->getErrors();
                $transaction->rollback();
            }
		} else {
            $result['error'] .= print_r($_REQUEST, true);
        }

        echo json_encode($result);

        Yii::app()->end();
	}


    public function actionUploadPhotoArchive()
    {
        $model=new CPhoto;
        $result = array('error' => '', 'msg' => '', 'html' => '');
        if (isset($_REQUEST['CPhoto'])) {
            $model->attributes=$_REQUEST['CPhoto'];
            $model->path=CUploadedFile::getInstance($model,'pathArchive');


            $archivePath = $model->path->getTempName();
            $archiveTempPath = '/tmp/upload/';

            die('path = '. $archivePath);


            $zip = new ZipArchive();
            if (!$zip->open($archivePath)) {
                $result['error'] = $model->getErrors();

                echo json_encode($result);
                Yii::app()->end();
            }
            $zip->extractTo($archiveTempPath);
            $zip->close();

            $files = Helpers::scandir($archiveTempPath, '*.jpeg');

            $transaction = $model->dbConnection->beginTransaction();

            //TODO - remove photos before delete!
            //$model->deleteAllByAttributes(array('article_id' => $model->article_id));
            $imagePath = $model->getImagePath();

            foreach($files as $fileNameOrig) {

                $fileName_ = Helpers::tempFileName(YiiBase::getPathOfAlias('application') . '/..' . $imagePath, '');
                $fileName = $fileName_ . '.' . $model->path->getExtensionName();
                $folder = YiiBase::getPathOfAlias('application') . '/..' . $imagePath ;

                $result['msg'] .= $folder . $fileName;

                move_uploaded_file($archiveTempPath . $fileNameOrig, $folder . $fileName);
                //$model->path->saveAs($folder . $fileName);

                $article = $model->article;
                if ($article->isSubArticle()) {
                    $article = $article->parent;
                }

                Helpers::imageresize($folder . '/big/' . $fileName, $folder . $fileName, $article->img_big_h, 1111, 90, array('fix_h' => true));
                Helpers::imageresize($folder . '/thumbs/' . $fileName, $folder . $fileName, $article->img_thumb_h, 1111, 90, array('fix_h' => true));

                $model->path = $fileName;
                $model->save();

                @unlink($folder . '/' . $fileName_);

                $li = Helpers::renderImageBlock ($imagePath, $fileName, $model->id);
                $result['html'] .= urlencode($li);
            }

            $transaction->commit();
        } else {
            $result['error'] .= print_r($_REQUEST, true);
        }

        echo json_encode($result);

        Yii::app()->end();
    }


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CPhoto']))
		{
			$model->attributes=$_POST['CPhoto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $result = array('error' => '', 'msg' => '', );

        //if(Yii::app()->request->isPostRequest)
		//{
			// we only allow deletion via POST request

			$model = $this->loadModel($id);
            $transaction=$model->dbConnection->beginTransaction();

            $imagePath = $model->getImagePath();
            $fileName = $model->path;
            $model->delete();

            $folder = YiiBase::getPathOfAlias('application') . '/..' . $imagePath ;

            $result['msg']['big'] = $folder . '/big/' . $fileName;
            if (file_exists($folder . '/big/' . $fileName)) {
                @unlink($folder . '/big/' . $fileName);
            }

            $result['msg']['thumbs'] = $folder . '/thumbs/' . $fileName;
            if (file_exists($folder . '/thumbs/' . $fileName)) {
                @unlink($folder . '/thumbs/' . $fileName);
            }

            $result['msg']['/'] = $folder . '/' . $fileName;
            if (file_exists($folder . '/' . $fileName)) {
                @unlink($folder . '/' . $fileName);
            }

            $transaction->commit();

            echo json_encode($result);

            Yii::app()->end();

//		}
//		else
//			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CPhoto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CPhoto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CPhoto']))
			$model->attributes=$_GET['CPhoto'];

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
		$model=CPhoto::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='cphoto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
