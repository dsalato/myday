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
<?php if (Yii::$app->user->isGuest): ?>
    <a class="logo_a" href="<?= Yii::$app->urlManager->createUrl('/') ?>"><img src="<?= Yii::$app->request->baseUrl?>/web/img/logo.png" width="200px" alt="photo"></a>
<?php endif ?>
<header>

    <?php if (!Yii::$app->user->isGuest): ?>
    <a href="<?= Yii::$app->urlManager->createUrl('/') ?>"><img src="<?= Yii::$app->request->baseUrl?>/web/img/logo.png" width="200px" alt="photo"></a>

    <div>

        <div class="header_item">
            <img class="header_img" src="<?= Yii::$app->user->identity->photo?>" width="60px" alt="avatar">
            <a href="<?= Yii::$app->urlManager->createUrl('user/profile')?>"><?= Yii::$app->user->identity->username?></a>

        </div>
        <div class="header_item">
            <img src="<?= Yii::$app->request->baseUrl?>/web/img/setting.png" width="20px" alt="setting">
            <a href="<?= Yii::$app->urlManager->createUrl('user/update?id=' . Yii::$app->user->identity->id)?>">Настройка аккаунта</a>
        </div>

    </div>
    <?= Html::a("Выйти из аккаунта",['site/logout'],
            ['data' => ['method' => 'post'],
                ['class' => 'while text-center']]);?>
    <?php endif ?>
</header>

<main class="h-100">
        <div class="wrap h-100">
            <div class="menu">
                <div>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <a href="<?= Yii::$app->urlManager->createUrl('site/login')?>">Вход</a>
                        <a href="<?= Yii::$app->urlManager->createUrl('site/register')?>">Регистрация</a>
                    <?php else: ?>
                        <?php if (Yii::$app->user->identity->role): ?>
                            <a href="<?= Yii::$app->urlManager->createUrl('user/index')?>">Пользователи</a>
                        <?php else: ?>
                        <a href="<?= Yii::$app->urlManager->createUrl('user/profile')?>">Профиль</a>
                        <a href="">Задачи</a>
                        <a href="">Заметки</a>
                        <a href="">Список покупок</a>
                        <a href="">Статистика</a>
                        <?php endif ?>
                    <?php endif ?>
                </div>

            </div>
            <div class="content h-100">
                <?= $content ?>
            </div>
        </div>

</main>

<footer class="">
    <p>© MyDay 2023. Все права защищены.</p>
</footer>

<?php if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
} $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
