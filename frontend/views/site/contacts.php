<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты';
?>
<div class="review-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            // return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
            $item = 
                '<div class="content-inner media border mt-3 mb-3 p-3 shadow">'
                    . '<div class="media-body">'
                        . '<h4>'
                        . $model->name . ': ' . $model->value
                        . '<small><i>'
                        . '<span class="badge badge-secondary ml-2">'                   
                        . '</span>'       
                        . '</i></small></h4>'
                    . '</div>'
                . '</div>';
            return $item;
        },
    ]) ?>

    <?php Pjax::end(); ?>

</div>
