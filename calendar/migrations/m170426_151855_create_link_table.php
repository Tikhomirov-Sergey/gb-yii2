<?php

use yii\db\Migration;

/**
 * Handles the creation of table `link`.
 */
class m170426_151855_create_link_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('link', [
            'id' => $this->primaryKey(),
            'link' => $this->string(50),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'rel_event_id' => $this->integer()
        ]);
        
        $this->addForeignKey('link_event_id', 'link', 'rel_event_id', 'event', 'id');
        
    }
    


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('link_event_id', 'link');
        $this->dropTable('link');
    }
}
