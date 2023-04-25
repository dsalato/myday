<?php

/** @var yii\web\View $this */

$this->title = 'MYDAY';
?>
<div class="site-index">
    <h1>MYDAY</h1>
    <p>Это твой личный ежедневник.
        Предназначен для того, чтобы автоматизировать планирование задач, событий, встреч, составление  расписания и список покупок.</p>
    <a class="index_a" href="<?= Yii::$app->urlManager->createUrl('site/login')?>">Начни планировать свою жизнь</a>

</div>
