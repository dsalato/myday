<?php
$this->title = 'Все пользователи';
?>

<div class="users">
    <div class="container">

        <h1 class="login_h1">Все пользователи</h1>
        <?php
        foreach ($users as $user) {
        ?>
        <div class="profile">

            <div>
                <img src="<?= $user->photo?>" width="200px" alt="avatar">
            </div>

            <div class="block">
                <div>
                    <p><?= $user->last_name?> <?= $user->first_name?></p>
                    <p><?= $user->email?></p>
                </div>
            </div>
            <div>
                <img src="<?= Yii::$app->request->baseUrl?>/web/img/delete.png" width="20px" alt="удалить">
                <img src="<?= Yii::$app->request->baseUrl?>/web/img/edit.png" width="20px" alt="изменить">
            </div>

        </div>
            <?php
        }
        ?>
    </div>
</div>