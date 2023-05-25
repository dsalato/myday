<?php

namespace app\models;

use Yii;
use app\models\Note;

class Statistic extends \yii\base\Model
{
    public function statistic()
    {
        $count = count(Note::findAll(['id_user' => Yii::$app->user->identity->id]));
        $done = count(Note::findAll(['id_user' => Yii::$app->user->identity->id, 'done' => 1]));
        $urgent = count(Note::findAll(['id_user' => Yii::$app->user->identity->id, 'priority' => 1, 'done' => 0]));

        $data = [
            'labels' => ['Обычные', 'Срочные', 'Выполненные'],
            'datasets' => [
                [
                    'label' => 'Заметки',
                    'backgroundColor' => ['#9699CA', '#F47D6C', '#77C7B9'],
                    'data' => [$count-$done-$urgent, $urgent, $done],
                ]
            ],
        ];

        return array($data, $count);
    }

}