<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->last_name .' '. $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-profile">
    <div class="container">
    <h1 class="login_h1"><?= Html::encode($this->title) ?></h1>

    <div class="view_user">
        <img src="<?= $model->photo?>" width="200px" alt="avatar">
        <div>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

                    'first_name',
                    'last_name',
                    'email:email',
                    'username',



                ],
            ]) ?>
        </div>
    </div>

    <p class="p_view">
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этого пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    </div>
</div>
