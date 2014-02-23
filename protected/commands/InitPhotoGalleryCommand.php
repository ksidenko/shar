<?php
class initPhotoGalleryCommand extends CConsoleCommand {

    public function actionRun($fakeMode = true) {

        ini_set('memory_limit', '300M');
        ini_set('max_execution_time', Yii::App()->params['image_render_max_execution_time']);

        $criteria = new CDbCriteria();
        $criteria->addInCondition("code", array('interer_flat', 'interer_house', 'interer_society'));
        $criteria->addCondition("lang='ru'");
        $articles = CArticle::model()->findAll($criteria);

        echo 'cnt = ' . count($articles) . "\n";

        foreach($articles as $article) {
            foreach ($article->subarticles as $subarticle) {
                $folder = realpath(Yii::App()->params['image_path']) . '/';
                echo "$folder\n";

                $photos = $subarticle->photos;
                if (!isset($photos[0])) continue;

                $photo = $photos[0];

                echo "{$article->code} | {$subarticle->code} | {$photo->path}" . PHP_EOL;
                //continue;

                $folder = $folder . "{$article->code}/{$subarticle->code}/";
                echo "folder: $folder" . PHP_EOL;
                if (!$fakeMode) {
                    @unlink($folder . 'main_' . $photo->path);
                    Helpers::imageresize($folder . 'main_' . $photo->path, $folder . $photo->path, 210, 210, 90);

                    $photoAR = CPhoto::model();
                    $photoAR->id = new CDbExpression('DEFAULT');
                    $photoAR->article_id = $subarticle->id;
                    $photoAR->path = "main_" . $photo->path;
                    $photoAR->setIsNewRecord(true);
                    $photoAR->is_main = true;
                    $photoAR->save();
                }
            }
        }
    }

}