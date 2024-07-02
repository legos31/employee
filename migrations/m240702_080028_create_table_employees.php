<?php

use yii\db\Migration;

/**
 * Class m240702_080028_create_table_emploees
 */
class m240702_080028_create_table_employees extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employees}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'email' => $this->string(255)->unique(),
            'attestation_date' => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240702_080028_create_table_employees cannot be reverted.\n";

        return false;
    }

}
