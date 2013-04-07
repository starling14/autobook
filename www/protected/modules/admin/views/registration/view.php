<?php

$this->menu=array(
	array('label'=>'Управління реєстрацією', 'url'=>array('index')),
);
?>

<h1>View Registration #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'password',
		'name',
		'role',
		'active',
		'date',
	),
)); ?>
