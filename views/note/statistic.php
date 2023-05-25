<?php

use dosamigos\chartjs\ChartJs;
/** @var yii\web\View $this */
/** @var app\models\Note $model */
?>


<div class="statistic">
        <p class="stat_h5">Статистика</p>
        <p>Количество заметок: <?= $count?></p>
<div>
    <?php
    echo ChartJs::widget([
        'type' => 'pie',
        'options' => [
            'height' => 260,
            'width' => 360,
        ],
        'data' => $data,
    ]);
    ?>
</div>

</div>