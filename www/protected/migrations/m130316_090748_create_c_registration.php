<?php

class m130316_090748_create_c_registration extends CDbMigration
{
	public function up()
	{
            $this->createTable('c_registration', array(
                'id' => 'pk',
                'email' => 'VARCHAR(100) NOT NULL',
                'password' => 'VARCHAR(50) NOT NULL',
                'name' => 'VARCHAR(50) NOT NULL',
                'role' => 'int(1) NOT NULL',
                'active' => 'int(1) NOT NULL',
                'date' => 'datetime NOT NULL',
                
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