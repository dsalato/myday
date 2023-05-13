<?php

use app\models\Note;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\Task $model */

$this->title = 'Задачи';
?>

<div class="note-list">
    <div class="container">
        <div class="list">
            <h1 class="login_h1">Задачи</h1>
            <?= Html::a('Добавить задачу', ['create'], ['class' => 'button-list']) ?>

        </div>
        <div class="data">
            <?= $this->render('_data') ?>
        </div>
        <?php
        foreach ($tasks as $task) {
            ?>
            <div class="tasks">
                <div class="task">
                    <a href="<?= Url::to(['task/view', 'id' => $task->id])?>">
                        <div class="task_content">
                            <p><?= Yii::$app->getFormatter()->asDatetime($task->time, 'H:mm')?></p>
                            <p><?= $task->name?></p>
                        </div>
                    </a>
                </div>

                <div class="notes_btn">
                    <a href="<?= Url::to(['task/delete', 'id' => $task->id])?>" data-method="post"><img src="<?= Yii::$app->request->baseUrl?>/web/img/delete.png" width="20px" alt="удалить"></a>
                    <a href="<?= Yii::$app->urlManager->createUrl('task/update?id=' . $task->id)?>"><img src="<?= Yii::$app->request->baseUrl?>/web/img/edit.png" width="20px" alt="изменить"></a>
                </div>
            </div>

            <?php
        }
        ?>

    </div>
</div>