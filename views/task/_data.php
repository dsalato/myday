<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="data">

    <?php $form = ActiveForm::begin([
        'action' => ['list'],
        'method' => 'get',
        'id' => 'register-form',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-form-label'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7'],
        ],
    ]);
    ?>
    <div class="date_filter">
        <p><?php
            if (Yii::$app->request->getQueryParam('date'))
                echo Yii::$app->request->getQueryParam('date');
            else
                echo date('Y-m-d');
            ?></p>
        <?= Html::input('date', 'date') ?>
        <button class="button-data">Выбор даты</button>
    </div>



    <?php ActiveForm::end(); ?>
</div>
