<?php

use yii\db\Migration;

/**
 * Handles the creation of table `application`.
 */
class m170417_155322_create_application_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('application', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'addres' => $this->string(255),
            'email' => $this->string(255),
            'phone' => $this->string(10),
            'date_create' => $this->dateTime()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('application');
    }
}
