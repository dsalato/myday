<?php
$this->title = 'Профиль';
?>

<div class="user-profile">
    <div class="container">

        <h1 class="login_h1">Профиль</h1>
        <div class="profile">
            <div>
                <img src="<?= Yii::$app->user->identity->photo?>" width="200px" alt="avatar">
            </div>

            <div class="block">
                <div>
                    <p><?= Yii::$app->user->identity->last_name?> <?= Yii::$app->user->identity->first_name?></p>
                    <p><?= Yii::$app->user->identity->email?></p>
                </div>
            </div>
            <div>
                <a href="<?= Yii::$app->urlManager->createUrl('user/update?id=' . Yii::$app->user->identity->id)?>"><img src="<?= Yii::$app->request->baseUrl?>/web/img/edit.png" width="20px" alt="изменить"></a>
            </div>
        </div>
    </div>
</div>