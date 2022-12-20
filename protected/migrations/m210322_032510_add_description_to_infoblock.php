<?php

class m210322_032510_add_description_to_infoblock extends CDbMigration
{
	public function up()
	{
        $this->addColumn('info_block', 'description', 'TEXT');
	}

	public function down()
	{
        $this->dropColumn('info_block', 'description');
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