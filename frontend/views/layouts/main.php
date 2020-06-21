<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use common\widgets\Alert;
use yii\bootstrap4\NavBar;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">    

    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'phpMyAdmin', 'url' => ['/phpmyadmin']],
        ['label' => 'Gii', 'url' => ['/gii']],
        ['label' => 'О нас', 'url' => ['/site/about']],
        ['label' => 'Контакты', 'url' => ['/site/contact']],
        ['label' => 'Отзывы', 'url' => ['/']],
        ['label' => 'Админка', 'url' => 'http://admin.diploma.net/'],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-white']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

<nav id="w1" class="navbar navbar-expand-md navbar-light">

<div class="container">

    <a class="logo d-flex" href="/">
        <img id="logo_img" src="/uploads/diploma.png">
        <h2 class="d-flex m-0 align-self-center">
            <span class="logo_word"><i>Diploma</i></span><span class="text-body">.net</span>
        </h2>
    </a>

    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#w1-collapse" aria-controls="w1-collapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

    <div id="w1-collapse" class="collapse navbar-collapse">
        <ul id="w2" class="navbar-nav ml-auto nav">
            <li class="nav-item"><a class="menu-link" href="/">Обмен</a></li>
            <li class="nav-item"><a class="menu-link" href="/">Отзывы</a></li>
            <li class="nav-item"><a class="menu-link" href="/">Контакты</a></li>
            <li class="nav-item"><a class="menu-link" href="/">Помощь</a></li>
            <li class="nav-item"><a class="menu-link" href="/">Бонусы</a></li>
            <li class="nav-item"><a class="menu-link" href="/">Войти</a></li>
            <li class="nav-item"><a class="menu-link" href="/">Создать аккаунт</a></li>
        </ul>
    </div>
</div>
</nav>


    <div class="container pt-4">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'class' => 'breadcrumb',
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
