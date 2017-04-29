<?php

namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Event[] $events
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $username;
    public $authKey;
    public $accessToken;
    
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
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'email','created_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['login'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 40],
            [['password'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'email' => 'Email',
            'password' => 'Password',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['rel_user_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
    
    public static function findIdentity($id)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne(['id'=>$id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {  
        return static::findOne(['login'=>$username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //print_r($this->password); echo '^'.$password.'^'.$this->password_hash; exit;
        //return $this->password == $password;
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
        //echo $password.' '.$this->password_hash; exit;
    }

    public function beforeSave($insert)
    {
        $this->setPassword($this->password);
        return parent::beforeSave($insert); 
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}
