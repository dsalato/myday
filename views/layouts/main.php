<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <img src="<?= Yii::$app->request->baseUrl?>/web/img/logo.png" width="200px" alt="photo">
    <div>
        <div class="header_item">
            <img src="<?= Yii::$app->request->baseUrl?>/web/img/avatar.png" width="60px" alt="avatar">
            <a href="">Ольга Петрова</a>
        </div>
        <div class="header_item">
            <img src="<?= Yii::$app->request->baseUrl?>/web/img/setting.png" width="20px" alt="setting">
            <a href="">Настройка аккаунта</a>
        </div>

    </div>
    <a href="">Выйти из аккаунта</a>
</header>

<main class="">
    <div class="container">

        <?= $content ?>
    </div>
</main>

<footer class="">

</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
