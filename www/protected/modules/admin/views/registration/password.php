<?php
$this->menu=array(
	array('label'=>'Управління реєстрацією', 'url'=>array('index')),
        array('label'=>'Редагувати дані користувача', 'url'=>array('update')),
);
?>
Вкажіть пароль: <br>
<?php
    echo CHtml::form();
    echo CHtml::textField('password');
    echo CHtml::submitButton('Змінити');
    echo CHtml::endForm();

?>