<?php
$this->breadcrumbs=array(
	'Carticles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CArticle', 'url'=>array('index')),
	array('label'=>'Create CArticle', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('carticle-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Carticles</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'carticle-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'parent_id',
		'code',
		'title',
		'meta',
		'keyword',
		/*
		'header',
		'descr',
		'dt_create',
		'img_big_h',
		'img_thumb_h',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
