<?php
$this->breadcrumbs=array(
	'Cphotos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CPhoto', 'url'=>array('index')),
	array('label'=>'Create CPhoto', 'url'=>array('create')),
	array('label'=>'Update CPhoto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CPhoto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CPhoto', 'url'=>array('admin')),
);
?>

<h1>View CPhoto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'article_id',
		'number',
		'path',
	),
)); ?>
