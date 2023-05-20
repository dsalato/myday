<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property int $id_user
 * @property string $name
 * @property string $description
 * @property int|null $priority
 * @property int|null $done
 *
 * @property Users $user
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'name', 'description'], 'required'],
            [['id_user', 'priority', 'done'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
            [['name', 'description'], 'match', 'pattern' => '/^[а-яА-ЯёЁa-zA-Z0-9 ]+$/u'],

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
            'description' => 'Описание',
            'priority' => 'Срочно',
            'done' => 'Выполнено',
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
