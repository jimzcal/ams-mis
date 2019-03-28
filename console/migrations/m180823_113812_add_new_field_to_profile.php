<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m180823_113812_add_new_field_to_profile
 */
class m180823_113812_add_new_field_to_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function up()
    {
        $this->addColumn('{{%profile}}', 'biometric', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('{{%profile}}', 'biometric');
    
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180823_113812_add_new_field_to_profile cannot be reverted.\n";

        return false;
    }
    */
}
