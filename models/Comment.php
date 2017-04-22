<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $text
 * @property string $date_create
 * @property integer $rel_user_id
 * @property integer $rel_post_id
 *
 * @property Post $relPost
 * @property User $relUser
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
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
            [['rel_user_id', 'rel_post_id'], 'integer'],
            [['rel_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['rel_post_id' => 'id']],
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
            'rel_post_id' => 'Rel Post ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'rel_post_id']);
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
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
    }
}
