<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int $id_user
 * @property string $name
 * @property string $date
 * @property string $time
 *
 * @property User $user
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'name', 'date', 'time'], 'required'],
            [['id_user'], 'integer'],
            [['date', 'time'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'match', 'pattern' => '/^[а-яА-ЯёЁa-zA-Z0-9 ]+$/u'],

            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'name' => 'Название',
            'date' => 'Дата',
            'time' => 'Время',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
