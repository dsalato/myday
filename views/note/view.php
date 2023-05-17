<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Note $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="note-list">
    <h1 class="login_h1"><?= Html::encode($this->title) ?></h1>
    <div class="container">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description',

        ],
    ]) ?>

    <p class="p_view">
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту заметку?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    </div>
</div>
