<?php
$this->breadcrumbs=array(
	'Cphotos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CPhoto', 'url'=>array('index')),
	array('label'=>'Manage CPhoto', 'url'=>array('admin')),
);
?>

<h1>Create CPhoto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>