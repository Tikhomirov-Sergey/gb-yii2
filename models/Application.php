<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property integer $id
 * @property string $name
 * @property string $addres
 * @property string $email
 * @property string $phone
 * @property string $date_create
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date_create'], 'required'],
            [['date_create'], 'safe'],
            [['name', 'addres', 'email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'addres' => 'Addres',
            'email' => 'Email',
            'phone' => 'Phone',
            'date_create' => 'Date Create',
        ];
    }

    /**
     * @inheritdoc
     * @return ApplicationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApplicationQuery(get_called_class());
    }
}
