<?php
$this->breadcrumbs=array(
	'Carticles',
);

$this->menu=array(
	array('label'=>'Create CArticle', 'url'=>array('create')),
	array('label'=>'Manage CArticle', 'url'=>array('admin')),
);
?>

<h1>Carticles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
