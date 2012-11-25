<?php
$this->breadcrumbs=array(
	'Cphotos',
);

$this->menu=array(
	array('label'=>'Create CPhoto', 'url'=>array('create')),
	array('label'=>'Manage CPhoto', 'url'=>array('admin')),
);
?>

<h1>Cphotos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
