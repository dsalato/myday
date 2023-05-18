
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="sort">

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
    <div class="sort_form">
        <select>
            <option>1</option>
            <option>2</option>
        </select>

        <button class="button-data">Выбор сортировки</button>
    </div>



    <?php ActiveForm::end(); ?>
</div>
