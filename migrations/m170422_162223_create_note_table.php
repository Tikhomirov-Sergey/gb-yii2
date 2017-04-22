<?php

use yii\db\Migration;

/**
 * Handles the creation of table `note`.
 */
class m170422_162223_create_note_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('note', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'date_create' => $this->dateTime()->notNull(),
            'rel_user_id' => $this->integer(),
        ]);
        
        $this->addForeignKey('note_user_id', 'note', 'rel_user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('note_user_id', 'note');
        $this->dropTable('note');
    }
}
