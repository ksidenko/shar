<?php

class ArticleController extends Controller
{
    public $layout='//layouts/index';

    public $lang = 'ru';
    public $arrLanguages = array('ru' => 'Русский', 'en' => 'Английский');
    public $returnUrl = '/';


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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create', 'update', 'delete'),
				'users'=>array('admin', 'shar'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    protected function beforeAction($action) {

        if ( !parent::beforeAction ($action) ) return false;

        $action = mb_strtolower($action->getId(), 'UTF-8');

        $this->lang = Yii::app()->request->getParam('lang' /*, Yii::app()->getLanguage()*/);

        $this->returnUrl = Yii::app()->request->getParam('returnUrl', $this->returnUrl);

        $basePath = Yii::getPathOfAlias('webroot.js');
        $baseUrlJs = Yii::app()->getAssetManager()->publish($basePath, true, -1, YII_DEBUG);

        if (in_array($action, array('update')) ) {
            Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/form.css?' . Yii::app()->params['hash_css'], CClientScript::POS_HEAD);
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
			'model'=>$this->loadModel($id, $this->lang),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        if (isset($_POST['cancel'])) {
            //Yii::app()->user->setFlash('success','Изменения были отменены');
            $this->redirect($this->returnUrl);
        }

        $parentId = Yii::app()->request->getParam('parent_id');
        $parentModel = $this->loadModel($parentId, 'ru');

        $articleModels = array();

        foreach ( $this->arrLanguages as $lang => $langName) {
            $articleModels[$lang] = $this->loadModel(null, $lang);
            $articleModels[$lang]->parent_id = $parentId;
            $articleModels[$lang]->isNewRecord = true;
            $articleModels[$lang]->number = 1;
        }

        $articleModel = $articleModels['ru'];
        $isSubArticle = $articleModel->isSubArticle();
        $subarticles = $articleModel->subarticles;

        if ($articleModel->isSubArticle()) {
            $articleHeader = $articleModel->parent->header;
        } else {
            $articleHeader = $articleModel->header;
        }

        if (isset($_POST['CArticle'])) {

            //echo '<pre>' . print_r($_POST, true) . '</pre>'; die;
            //echo '<pre>' . print_r($this->arrLanguages, true) . '</pre>'; die;

            $countSuccess = 0;

            try {
                $transaction = $articleModel->dbConnection->beginTransaction();

                $number = $_POST['CArticle']['number'];

                $parentModel->updateAll( array(
                        'number' => new CDbExpression( 'number + 1' )
                    ),
                    "parent_id=:parent_id and number >= :number",
                    array(
                        ':parent_id' => $parentId,
                        ':number' => $number
                    )
                );

                $articleId = Yii::app()->db->createCommand()
                    ->select('max(id)+1')
                    ->from('article')
                    ->queryScalar();

                $articleCode = Yii::app()->db->createCommand()
                    ->select('max(code)+1')
                    ->from('article')
                    ->where("parent_id=:parent_id", array(':parent_id' => $parentId))
                    ->queryScalar();

                foreach ( $this->arrLanguages as $lang => $langName) {
                    $model = $articleModels[$lang];

                    $model->attributes = $_POST['CArticle'][$lang];
                    $model->attributes = $_POST['CArticle'];

                    $model->id = $articleId;
                    $model->lang = $lang;

                    $model->code = $articleCode;

                    $model->img_big_h = $parentModel->img_big_h;
                    $model->img_thumb_h = $parentModel->img_thumb_h;

                    $model->isNewRecord = true;

                    //echo '<pre>' . print_r($model->attributes, true) . '</pre>';
                    if ($model->save(true)) {
                        $countSuccess++;
                    }
                }
            } catch (Exception $e) {
                Yii::app()->user->setFlash('error',$e->getMessage());
            }

            //$transaction->rollback();die();

            if ( $countSuccess == count($this->arrLanguages) ) {
                $transaction->commit();
                Yii::app()->user->setFlash('success','Статья успешно добавлена!');
                $this->redirect('/article/update/id/' . $parentId);
            } else {
                $transaction->rollback();
                Yii::app()->user->setFlash('error','Ошибка при добавлении статьи');
            }
        }

        $this->render('create', array(
            'articleModels' => $articleModels,
            'articleModel' => $articleModel,
            'articleHeader' => $articleHeader,
            'isSubArticle' => $isSubArticle,
            'subarticles' => $subarticles,
        ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        //print_r($_REQUEST); die;
        if (isset($_POST['cancel'])) {
            //Yii::app()->user->setFlash('success','Изменения были отменены');
            $this->redirect($this->returnUrl);
        }

        $articleModels = array();

        foreach ( $this->arrLanguages as $lang => $langName) {
            $articleModels[$lang] = $this->loadModel($id, $lang);
        }
        $articleModel = $articleModels['ru'];
        $isSubArticle = $articleModel->isSubArticle();
        $subarticles = $articleModel->subarticles;

        if ($articleModel->isSubArticle()) {
            $articleHeader = $articleModel->parent->header;
        } else {
            $articleHeader = $articleModel->header;
        }

		if (isset($_POST['CArticle'])) {

            //echo '<pre>' . print_r($_POST, true) . '</pre>'; die;
            $transaction = $articleModel->dbConnection->beginTransaction();

            if ($isSubArticle) {
                $origNumber = $articleModel->number;
                $newNumber = $_POST['CArticle']['number'];

                if ( $origNumber != $newNumber ) {

                    //reorder article numbers
                    if ( $origNumber > $newNumber ) {
                        $articleModel->updateAll( array(
                                'number' => new CDbExpression( 'number + 1' )
                            ),
                            "parent_id=:parent_id and :min_number <= number and number < :max_number ",
                            array(
                                ':parent_id' => $articleModel->parent_id,
                                ':min_number' => min($origNumber, $newNumber),
                                ':max_number' => max($origNumber, $newNumber),
                            )
                        );
                    } else {
                        $articleModel->updateAll( array(
                                'number' => new CDbExpression( 'number - 1' )
                            ),
                            "parent_id=:parent_id and :min_number < number and number <= :max_number ",
                            array(
                                ':parent_id' => $articleModel->parent_id,
                                ':min_number' => min($origNumber, $newNumber),
                                ':max_number' => max($origNumber, $newNumber),
                            )
                        );
                    }
                }
            }

            $countSuccess = 0;
            foreach ( $this->arrLanguages as $lang => $langName) {
                $model = $articleModels[$lang];

                $model->attributes = $_POST['CArticle'][$lang];
                $model->attributes = $_POST['CArticle'];

                if ($model->save()) {
                    $countSuccess++;
                }
            }
            if ( $countSuccess == count($this->arrLanguages) ) {
                $transaction->commit();
                Yii::app()->user->setFlash('success','Информация успешно обновлена!');
                $this->redirect($this->returnUrl);
            } else {
                $transaction->rollback();
                Yii::app()->user->setFlash('error','Ошибка при редактировании статьи');
            }
		}

        $code = $articleModel->code;
        $activePage = '';
        if ($isSubArticle) {
            $activePage = "/" . $articleModel->code;
            $code = $articleModel->parent->code;
        }

        $photos = CPhoto::model()->findAllByAttributes(array('article_id' => $id, 'is_main' => 0));
        $path = "/images/articles/{$code}{$activePage}/";

		$this->render('update',array(
			'articleModels' => $articleModels,
            'articleModel' => $articleModel,
            'articleHeader' => $articleHeader,
            'isSubArticle' => $isSubArticle,
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
        $articleModel = $this->loadModel($id, 'ru');

        if ($articleModel->isSubArticle()) {
            $photoModel = CPhoto::model();

            $transaction = $articleModel->dbConnection->beginTransaction();

            $articleModel->deleteAll( 'id=:id', array(':id' => $id) );
            $photoModel->deleteAll( 'article_id=:article_id', array(':article_id' => $id) );

            $articleModel->updateAll(
                array( 'number' => new CDbExpression( 'number - 1' )),
                "parent_id=:parent_id and number > :number",
                array(
                    ':parent_id' => $articleModel->parent_id,
                    ':number' => $articleModel->number
                )
            );

            $imagePath = $articleModel->getImagePath();

            $folder = YiiBase::getPathOfAlias('application') . '/..'. $imagePath;
            if (file_exists($folder)) {
                Helpers::deleteDirectory($folder);
            }

            $transaction->commit();
            Yii::app()->user->setFlash('success', 'Страница успешно удалена.');

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect($this->returnUrl);
        }
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
	public function loadModel($id, $lang)
	{
        if ($id != null) {
		    $model=CArticle::model()->findByPk(array('id' => $id, 'lang' => $lang));
		    if($model===null)
			    throw new CHttpException(404,'The requested page does not exist.');
        } else {
            $model = CArticle::model();
            $model->lang = $lang;
        }
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
