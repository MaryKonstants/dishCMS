<?php

class m210511_085354_add_eav_dictionary_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('eav_dictionary', array(
            'id' => 'pk',
            'id_attrs' => 'integer NOT NULL',
            'value' => 'string',
            'property' => 'string',
        ));
    }

    public function down()
    {
        $this->dropTable('eav_dictionary');
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