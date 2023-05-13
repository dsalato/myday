<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string|null $photo
 * @property int|null $role
 *
 * @property Notes[] $notes
 * @property Products[] $products
 * @property Tasks[] $tasks
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $repeat_password;
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }


    public function attributeLabels()
    {
        return [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'Почта',
            'username' => 'Логин',
            'password' => 'Пароль',
            'repeat_password' => 'Повторите пароль',
            'file' => 'Аватар',
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'username', 'password', 'file'], 'required'],
            [['role'], 'integer'],
            [['first_name', 'last_name', 'email', 'username', 'password', 'photo'], 'string', 'max' => 255],
            [['first_name','last_name'], 'match', 'pattern' => '/^[а-яА-ЯёЁ ]+$/u'],
            [['username','password'], 'match', 'pattern' => '/^[a-zA-Z0-9 ]+$/u'],
            [['email'], 'email'],
            [['username'], 'unique'],
            [['repeat_password'], 'compare', 'compareAttribute' => 'password'],
            [
                ['file'], 'file',
                'skipOnEmpty' => false,
                'extensions' => 'jpg, png, jpeg, bmp', 'maxSize' => 1024 * 1024 * 10
            ]

        ];
    }
    public function upload()
    {
        if (!$this->file)
            return false;
        $name = '/web/uploads/' . time() . '.' . $this->file->extension;
        $filename = Yii::getAlias('@webroot') . $name;
        $url = Yii::getAlias('@web') . $name;
        if ($this->file->saveAs($filename))
            return $url;
        return false;
    }
    /**
     * {@inheritdoc}
     */


    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Note::class, ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::class, ['id_user' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
