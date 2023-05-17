<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">
    <h1 class="login_h1"><?= Html::encode($this->title) ?></h1>
    <div class="container">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'count',
                'price',
            ],
        ]) ?>
    <p class="p_view">
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту покупку?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    </div>
</div>
