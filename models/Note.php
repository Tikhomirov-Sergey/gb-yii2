<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "note".
 *
 * @property integer $id
 * @property string $text
 * @property string $date_create
 * @property integer $rel_user_id
 *
 * @property User $relUser
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'date_create'], 'required'],
            [['text'], 'string'],
            [['date_create'], 'safe'],
            [['rel_user_id'], 'integer'],
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
            'text' => 'Text',
            'date_create' => 'Date Create',
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
     * @inheritdoc
     * @return NoteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NoteQuery(get_called_class());
    }
}
