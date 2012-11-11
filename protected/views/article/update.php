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

<h1 class="article" >Редактирование страницы "<?php echo $articleHeader; ?>"</h1>

<?php echo $this->renderPartial('_form', array(
    'model'=>$model,
    'subarticles' => $subarticles,
    'path' => $path,
    'files' => $files,
)); ?>

</div>