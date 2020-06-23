<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top p-0" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <?= Html::a('Выйти', 'site/logout', $options = ['class' => 'btn btn-danger mr-3', 'data' => [
                                    'confirm' => 'Вы уверены?',
                                    'method' => 'post',
                                ],]) ?>                                
        
    </nav>
</header>
