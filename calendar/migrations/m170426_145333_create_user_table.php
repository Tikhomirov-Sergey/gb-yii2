<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170426_145333_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'login' => $this->string(30)->notNull(),
            'email' => $this->string(40)->notNull(),
            'password' => $this->string(100)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()
        ]);
    }
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
