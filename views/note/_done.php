<?php

use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Note $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div>
    <div>

        <?php $form = ActiveForm::begin([
            'id' => 'done-form',
            'fieldConfig' => [
                'template' => "{input}",
                'inputOptions' => ['class' => 'col-lg-3 form-control'],
            ],
        ]); ?>

        <?= $form->field($model, 'id')->input('hidden', ['value' => "$model->id"]) ?>

        <?php if ($model->done === 0): ?>

        <?= $form->field($model, 'done')->input('hidden', ['value' => '1']) ?>

        <button class="button-check">
            <img src="<?= Yii::$app->homeUrl ?>/web/img/checkbox-empty.png" alt="" width="20px" height="20px">
        </button>

        <?php else: ?>

        <?= $form->field($model, 'done')->input('hidden', ['value' => '0']) ?>

        <button class="button-check">
            <img src="<?= Yii::$app->homeUrl ?>/web/img/checkbox.png" alt="" width="20px" height="20px">
        </button>

        <?php endif ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>
