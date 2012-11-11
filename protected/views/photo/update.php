<?php
$this->breadcrumbs=array(
	'Cphotos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CPhoto', 'url'=>array('index')),
	array('label'=>'Create CPhoto', 'url'=>array('create')),
	array('label'=>'View CPhoto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CPhoto', 'url'=>array('admin')),
);
?>

<h1>Update CPhoto <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>