<?php
$this->title = 'Изменение профиля';
?>

<div class="user-profile">
    <div class="container">

        <h1 class="login_h1">Изменение профиля</h1>
        <?php $form = ActiveForm::begin([
            'id' => 'register-form',
            'enableAjaxValidation' => true,
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'col-form-label'],
                'inputOptions' => ['class' => 'col-lg-3 form-control'],
                'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
            ],
        ]); ?>

        <?= $form->field($model, 'first_name') ?>
        <?= $form->field($model, 'last_name') ?>
        <?= $form->field($model, 'email')?>
        <?= $form->field($model, 'file', ['enableAjaxValidation' => false])->fileInput() ?>

        <button class="button-register">Зарегистрироваться</button>

        <?php ActiveForm::end(); ?>
    </div>

    </div>
</div>