<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Регистрация';
/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
?>
<div class="site-register">
    <div class="container">
        <h1 class="login_h1">Регистрация</h1>
    <?php $form = ActiveForm::begin([
        'id' => 'register-form',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-form-label'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7'],
        ],
    ]); ?>

        <?= $form->field($model, 'first_name') ?>
        <?= $form->field($model, 'last_name') ?>
        <?= $form->field($model, 'email')?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'repeat_password')->passwordInput() ?>
        <?= $form->field($model, 'file', ['enableAjaxValidation' => false])->fileInput() ?>

        <button class="button-register">Зарегистрироваться</button>

    <?php ActiveForm::end(); ?>
    </div>

</div><!-- site-register -->
