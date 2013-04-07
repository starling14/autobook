<?php
$this->menu=array(
	array('label'=>'Управління реєстрацією', 'url'=>array('index')),
        array('label'=>'Зміна паролю', 'url'=>array('password', 'id'=>$model->id)),
);
?>

<h1>Змінити дані реєстрації <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>