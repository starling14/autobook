<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#registration-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управління реєстрацією</h1>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'registration-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id'=> array(
                    'name'=>'id',
                    'headerHtmlOptions'=> array('width'=>30), // змінює ширину id
                ),
		'email',
		'password',
		'name',
		'role'=> array(
                    'name'=>'role',
                    'value'=> '($data->role==0)?"Користувач":"Клієнт"',
                    'filter'=> array(0=>"Користувач", 1=>"Клієнт"),
                ),
		'active'=> array(
                    'name'=>'active',
                    'value'=> '($data->active==0)?"Ні":"Так"',
                    'filter'=> array(0=>"Ні", 1=>"Так"),
                ),
		'date'=> array(
                    'name'=>'date',
                    'value'=> 'date("j.m.Y H:i", $data-> date)',
                    'filter'=> false,
                ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
