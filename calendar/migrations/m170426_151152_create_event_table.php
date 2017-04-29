<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event`.
 */
class m170426_151152_create_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'text' => $this->text(),
            'date' => $this->dateTime(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'rel_user_id' => $this->integer()
        ]);
        
        $this->addForeignKey('event_user_id', 'event', 'rel_user_id', 'user', 'id');
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('event_user_id', 'event');
        $this->dropTable('event');
    }
}
