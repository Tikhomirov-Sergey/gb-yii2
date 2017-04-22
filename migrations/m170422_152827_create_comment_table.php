<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m170422_152827_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'date_create' => $this->dateTime()->notNull(),
            'rel_user_id' => $this->integer(),
            'rel_post_id' => $this->integer(),
        ]);
        
        $this->addForeignKey('comment_user_id', 'comment', 'rel_user_id', 'user', 'id');
        $this->addForeignKey('comment_post_id', 'comment', 'rel_post_id', 'post', 'id');
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('comment_user_id', 'comment');
        $this->dropForeignKey('comment_post_id', 'comment');
        $this->dropTable('comment');
    }
}
