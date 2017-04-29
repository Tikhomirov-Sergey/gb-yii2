<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "link".
 *
 * @property integer $id
 * @property string $link
 * @property string $created_at
 * @property string $updated_at
 * @property integer $rel_event_id
 *
 * @property Event $relEvent
 */
class Link extends \yii\db\ActiveRecord
{
    
     public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ]
            ]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['rel_event_id'], 'integer'],
            [['link'], 'string', 'max' => 50],
            [['rel_event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['rel_event_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'rel_event_id' => 'Rel Event ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'rel_event_id']);
    }

    /**
     * @inheritdoc
     * @return LinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LinkQuery(get_called_class());
    }
}
