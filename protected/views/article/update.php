<?php
//$this->breadcrumbs=array(
//	'Carticles'=>array('index'),
//	$model->title=>array('view','id'=>$model->id),
//	'Update',
//);
//
//$this->menu=array(
//	array('label'=>'List CArticle', 'url'=>array('index')),
//	array('label'=>'Create CArticle', 'url'=>array('create')),
//	array('label'=>'View CArticle', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage CArticle', 'url'=>array('admin')),
//);
?>
<div class="middle-inner">

    <?php
    $pageTitle = "Редактирование страницы '$articleHeader'";

    if ($model->isSubArticle()) {
        $pageCode = $model->code;
        $pageTitle = $pageTitle . " ($pageCode)";
    }
    ?>
<div class="menu-hline"><h1 class="g-fleft"><?php echo $pageTitle; ?></h1></div>

<?php echo $this->renderPartial('_form', array(
    'model'=>$model,
    'subarticles' => $subarticles,
    'path' => $path,
    'files' => $files,
    'returnUrl' => $returnUrl,
)); ?>

</div>