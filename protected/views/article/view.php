<?php
$this->breadcrumbs=array(
	'Carticles'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List CArticle', 'url'=>array('index')),
	array('label'=>'Create CArticle', 'url'=>array('create')),
	array('label'=>'Update CArticle', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CArticle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CArticle', 'url'=>array('admin')),
);
?>

<h1>View CArticle #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'code',
		'title',
		'meta',
		'keyword',
		'header',
		'descr',
		'dt_create',
		'img_big_h',
		'img_thumb_h',
	),
)); ?>
