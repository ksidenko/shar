<div class="middle-inner">

    <?php
        $pageTitle = "Создание страницы для '$articleHeader'";
    ?>

    <div class="menu-hline"><h1 class="g-fleft"><?php echo $pageTitle; ?></h1></div>

    <?php echo $this->renderPartial('_form', array(
        'articleModels' => $articleModels,
        'articleModel' => $articleModel,
        'subarticles' => $subarticles,
        'isSubArticle' => $isSubArticle,
        //'path' => $path,
        //'files' => $files,
    )); ?>

</div>