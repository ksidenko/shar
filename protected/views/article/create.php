<?php
//$this->breadcrumbs=array(
//	'Carticles'=>array('index'),
//	'Create',
//);
//
//$this->menu=array(
//	array('label'=>'List CArticle', 'url'=>array('index')),
//	array('label'=>'Manage CArticle', 'url'=>array('admin')),
//);
?>
<div class="middle-inner">

    <h1 class="article" >Создание страницы для "<?php echo $model->parent->header; ?>"</h1>

    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>