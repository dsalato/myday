<?php

use app\models\Note;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Задачи';
?>

<div class="note-list">
    <div class="container_product">
        <div class="list">
            <h1 class="login_h1">Список покупок</h1>
            <?= Html::a('Добавить покупку', ['create'], ['class' => 'button-list']) ?>
        </div>
    </div>
        <div class="container">
        <?php
        foreach ($products as $product) {
            ?>
            <div class="products">
                <div class="product">
                    <a href="<?= Url::to(['product/view', 'id' => $product->id])?>">
                        <div class="product_content">
                            <p><?= $product->name?></p>
                            <p><?= $product->count?>шт</p>
                            <p><?= $product->price?>руб</p>
                        </div>
                    </a>
                </div>

                <div class="notes_btn">
                    <a href="<?= Url::to(['product/delete', 'id' => $product->id])?>" data-method="post"><img src="<?= Yii::$app->request->baseUrl?>/web/img/delete.png" width="20px" alt="удалить"></a>
                    <a href="<?= Yii::$app->urlManager->createUrl('product/update?id=' . $product->id)?>"><img src="<?= Yii::$app->request->baseUrl?>/web/img/edit.png" width="20px" alt="изменить"></a>
                </div>
            </div>

            <?php
        }
        ?>

    </div>
</div>