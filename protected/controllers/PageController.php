<?php

class PageController extends Controller
{
    public $layout='//layouts/index';

    public $pageTextInfo;
    public $pageKeywords;
    public $pageDescription;


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
                'actions'=>array('*'),
                'users'=>array('*'),
            ),
        );
    }


    protected function beforeAction($action) {
        if ( !parent::beforeAction ($action) ) return false;

        $action = mb_strtolower($action->getId(), 'UTF-8');

        $basePath = Yii::getPathOfAlias('webroot.js');
        $baseUrlJs = Yii::app()->getAssetManager()->publish($basePath, true, -1, YII_DEBUG);

        switch ($action){
            case 'main':
                Yii::app()->clientScript->registerScriptFile($baseUrlJs . '/image_resizer.js', CClientScript::POS_END);
                break;

            case 'intereralbum':
                Yii::app()->clientScript->registerScriptFile($baseUrlJs . '/jquery.SudoSlider/jquery.sudoSlider.min.js', CClientScript::POS_END);
                //Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/style-gallery.css?' . Yii::app()->params['hash_css'], CClientScript::POS_HEAD);
                break;

            case 'interer':
            case 'graph':
                Yii::app()->clientScript->registerScriptFile($baseUrlJs . '/jquery.ad-gallery/jquery.ad-gallery.js', CClientScript::POS_BEGIN);
                Yii::app()->clientScript->registerCssFile($baseUrlJs . '/jquery.ad-gallery/jquery.ad-gallery.css?' . Yii::app()->params['hash_css']);
                Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/jquery.ad-gallery.css?' . Yii::app()->params['hash_css']);
                Yii::app()->clientScript->registerScriptFile($baseUrlJs . '/gallery_init.js', CClientScript::POS_BEGIN);

                Yii::app()->clientScript->registerScriptFile($baseUrlJs . '/jquery.lightbox/js/jquery.lightbox-0.5.pack.js', CClientScript::POS_END);
                Yii::app()->clientScript->registerCssFile($baseUrlJs . '/jquery.lightbox/css/jquery.lightbox-0.5.css?' . Yii::app()->params['hash_css']);
                Yii::app()->clientScript->registerScriptFile($baseUrlJs . '/lightbox_init.js', CClientScript::POS_END);

                Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/form.css?' . Yii::app()->params['hash_css']);
                break;

            default:

                break;
        }

   		return true;
   	}

	public function actionIndex() {
        //Yii::app()->clientScript->reset();
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/style.css?' . Yii::app()->params['hash_css']);
        //Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/style2.css');

        $this->layout = '//layouts/start_page';
        $this->pageTitle = Yii::t('app', 'start_page');

		$this->render('index');
	}

    public function actionMain() {
        $this->pageTitle = Yii::t('app', 'main_page');

        $this->render('main');
    }

    public function actionInterer($type = 'flat', $activePage = 1) {
        $lang = Yii::app()->getLanguage();

        $returnUrl = '/page/interer/activePage/' . $activePage . '/type/' . $type . '/lang/' . $lang;


        $code = 'interer_' . $type;
        $article = CArticle::model()->findByAttributes(array('code' => $code, 'lang' => $lang));

        if ($article == false) {    $this->redirect('/main');   }

        $this->pageTitle = !empty($article->title) ? $article->title : $article->header;
        $this->pageKeywords = $article->keyword;
        $this->pageDescription = $article->descr;

        $articleHeader = $article->header;

        $subarticle = CArticle::model()->findByAttributes(array('parent_id' => $article->id, 'number' => $activePage, 'lang' => $lang));
        if ($subarticle == false) {    $this->redirect('/main');   }

        $this->pageTextInfo = $subarticle->descr;
        //print_r($this->pageTextInfo);
        $countPage = count($article->subarticles);

        $photos = CPhoto::model()->findAllByAttributes(array('article_id' => $subarticle->id, 'is_main' => 0));
        //print_r(count($photos)); die;
        if ($activePage > $countPage) {
            $activePage = 1;
        }

        $path = "/images/articles/{$article->code}/{$subarticle->code}/";
        //print_r($path); die;
        $this->render('interer', array(
              'article' => $article,
              'articleHeader' => $articleHeader,
              'returnUrl' => $returnUrl,
              'type' => $type,
              'path' => $path,
              'files' => $photos,
              'activePage' => $activePage,
              'countPage' => $countPage,
              'descr' => $subarticle->descr,
            )
        );
    }

    public function actionIntererAlbum($type = 'flat') {
        $lang = Yii::app()->getLanguage();

        $returnUrl = '/page/intererAlbum/' . '/type/' . $type . '/lang/' . $lang;

        $code = 'interer_' . $type;
        $article = CArticle::model()->findByAttributes(array('code' => $code, 'lang' => $lang));

        if ($article == false) {    $this->redirect('/main');   }

        $this->pageTitle = !empty($article->title) ? $article->title : $article->header;
        $this->pageKeywords = $article->keyword;
        $this->pageDescription = $article->descr;

        $articleHeader = $article->header;

        $command = Yii::app()->db->createCommand("
          SELECT *, (select path from photo p where p.article_id = a.id and is_main = 1) as main_logo_path
          FROM article a
          WHERE
            a.parent_id = :article_id and a.lang = :lang
            order by a.number
        ");

        $command->params = array(
            ':article_id' => $article->id,
            ':lang' => $lang
        );

        $photoGalleryData = $command->queryAll();

        $this->render('interer-gallery', array(
                'article' => $article,
                'photoGalleryData' => $photoGalleryData,
                'returnUrl' => $returnUrl,
                'type' => $type,
             )
        );
    }

    public function actionGraph($type = 'sign') {
        $lang = Yii::app()->getLanguage();
        $returnUrl = '/page/graph/type/' . $type . '/lang/' . $lang;


        $code = 'graph_' . $type;
        $article = CArticle::model()->findByAttributes(array('code' => $code, 'lang' => $lang));
        if ($article == false) {    $this->redirect('/main');   }

        $this->pageTitle = !empty($article->title) ? $article->title : $article->header;
        $this->pageKeywords = $article->keyword;
        $articleHeader = $article->header;

        $photos = CPhoto::model()->findAllByAttributes(array('article_id' => $article->id));
        //print_r($photos); die;

        $path = "/images/articles/{$article->code}/";

        $this->render('interer', array(
                                      'article' => $article,
                                      'articleHeader' => $articleHeader,
                                      'returnUrl' => $returnUrl,
                                      'type' => $type,
                                      'path' => $path,
                                      'files' => $photos)
        );
    }


    public function actionPrice() {
        $lang = Yii::app()->getLanguage();
        $this->pageTitle = Yii::t('app', 'page_price');

        $this->render('price-' . $lang, array());
    }

    public function actionContacts() {
        $lang = Yii::app()->getLanguage();
        $this->pageTitle = Yii::t('app', 'page_contacts');

        $this->render('contacts-' . $lang, array());
    }

    public function actionPartners() {
        $lang = Yii::app()->getLanguage();
        $this->pageTitle = Yii::t('app', 'page_partners');

        $this->render('partners-' . $lang, array());
    }

}