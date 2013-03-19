<?php

class m130316_090748_create_c_registration extends CDbMigration
{
	public function up()
	{
            $this->createTable('c_registration', array(
                'id' => 'pk',
                'login' => 'VARCHAR(100) NOT NULL',
                'password' => 'VARCHAR(50) NOT NULL',
                'name' => 'VARCHAR(200) NOT NULL',
                'role' => 'int(1) NOT NULL',
                'active' => 'int(1) NOT NULL',
                'date' => 'string NOT NULL',
                
            ));
	}

	public function down()
	{
		echo "m130316_090748_create_c_registration does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}