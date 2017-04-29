<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $date
 * @property string $created_at
 * @property string $updated_at
 * @property integer $rel_user_id
 *
 * @property User $relUser
 * @property Link[] $links
 */
class Event extends \yii\db\ActiveRecord
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
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['text'], 'string'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['rel_user_id'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['rel_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['rel_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'date' => 'Дата события',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'rel_user_id' => 'Rel User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelUser()
    {
        return $this->hasOne(User::className(), ['id' => 'rel_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinks()
    {
        return $this->hasMany(Link::className(), ['rel_event_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventQuery(get_called_class());
    }
}
