<?php

use app\models\Note;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Заметки';
?>

<div class="note-list">
    <div class="statistic">
        <p class="stat_h5">Статистика</p>
        <p>Количество заметок: <?= $count?></p>
        <p>Количество выполненных заметок: <?= $done?></p>
    </div>
    <div class="container">
        <div class="list">
            <h1 class="login_h1">Заметки</h1>
            <?= Html::a('Добавить заметку', ['create'], ['class' => 'button-list']) ?>

        </div>
        <?php
        foreach ($notes as $note) {
        ?>
        <?php if ($note->priority == 1):?>
                <div class="notes_color">
        <?php else: ?>
                <div class="notes">
        <?php endif ?>
                    <a href="<?= Url::to(['note/view', 'id' => $note->id])?>"><p><?= $note->name?></p></a>


                    <div class="notes_btn">
                        <input type="checkbox" name="done" value="1">
                        <a href="<?= Url::to(['note/delete', 'id' => $note->id])?>" data-method="post"><img src="<?= Yii::$app->request->baseUrl?>/web/img/delete.png" width="20px" alt="удалить"></a>
                        <a href="<?= Yii::$app->urlManager->createUrl('note/update?id=' . $note->id)?>"><img src="<?= Yii::$app->request->baseUrl?>/web/img/edit.png" width="20px" alt="изменить"></a>
                    </div>
                </div>

            <?php
        }
        ?>

    </div>
</div>