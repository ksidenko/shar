<?php
class initphotoCommand extends CConsoleCommand {

    public $articleId;

    public function actionIndex($articleId = null, $deletePhoto = false) {

        $dir = Yii::App()->params['image_path'];
        echo "$dir\n";
        ini_set('memory_limit', '300M');
        ini_set('max_execution_time', Yii::App()->params['image_render_max_execution_time']);

        if (!$articleId) {
            $articles = CArticle::model()->findAllByAttributes(array('lang' => 'en'));
        } else {
            $articles = CArticle::model()->findAllByAttributes(array('id' => $articleId, 'lang' => 'en'));
        }

        echo 'cnt = ' . count($articles) . "\n";
        foreach($articles as $article) {
            $countPage = count($article->subarticles);

            echo "countPage = $countPage\n";
            $toProccess = array();

            if ($countPage > 0) {
                foreach ($article->subarticles as $subarticle) {
                    $toProccess [$subarticle->id] = "{$article->code}/{$subarticle->code}/";
                }
            } else {
                $toProccess [$article->id] = "{$article->code}/";
            }
            //print_r( $toProccess ); die;

            foreach($toProccess as $articleId => $folder) {
                $folder = $dir . $folder;
                if (!file_exists($folder)) {
                    continue;
                }

                echo "articleId = $articleId\n";
                $photo = CPhoto::model();
                $photo->deleteAll('article_id = ' .  $articleId);

                if (!file_exists($folder . '/big/')) {
                    mkdir($folder . '/big/');
                }

                if (!file_exists($folder . '/thumbs/')) {
                   mkdir($folder . '/thumbs/');
                }

                $files = Helpers::scandir($folder, '/.*(.jpg|.jpeg)$/i');
                echo "folder=$folder --> " . count($files) . "\n";

                foreach($files as $file){
                   $photo = CPhoto::model();
                   //$photo->id = null;
                   $photo->article_id = $articleId;
                   $photo->id = new CDbExpression('DEFAULT');
                   $photo->path = $file;
                   $photo->setIsNewRecord(true);
                   $res = $photo->save();

                    if (!$res) {
                        echo "file = $file not saved!\n";
                        print_r($photo->getErrors());
                    }

                   if ($deletePhoto) {
                       if (file_exists($folder . '/big/'. $file)) {
                            @unlink($folder . '/big/'. $file);
                       }
                       if (file_exists($folder . '/thumbs/'. $file)) {
                           @unlink($folder . '/thumbs/'. $file);
                       }
                   }

                   try {
                       if (!file_exists($folder . '/big/'. $file)) {
                           Helpers::imageresize($folder . '/big/' . $file, $folder . '/' . $file, 1111, $article->img_big_h , 90, array('fix_h' => true));
                       }
                       if (!file_exists($folder . '/thumbs/'. $file)) {
                           Helpers::imageresize($folder . '/thumbs/' . $file, $folder . '/' . $file, $article->img_thumb_h, 1111, 90, array('fix_h' => true));
                       }
                       echo '.';
                   } catch (Exception $e) {
                       echo 'Error rais when resize file:' . $file . PHP_EOL;
                       echo $e->getCode(). ': '. $e->getMessage() . PHP_EOL;
                   }
                }

            }
        }
    }

}