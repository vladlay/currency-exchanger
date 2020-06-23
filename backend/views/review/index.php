<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
$img = Html::img('@uploads/'. 'avatar.png', ['class' => 'avatar mr-3 mt-3 rounded-circle']);
?>
<div class="review-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Оставить отзыв', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) use ($img) {
            // return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
            $item = 
                '<div class="content-inner media border mt-3 mb-3 p-3 shadow">'
                    . $img
                    . '<div class="media-body">'
                        . '<h4>'
                        . $model->created_by 
                        . '<small><i>'
                        . '<span class="badge badge-secondary ml-2">'
                        . date('Y-m-d H:i:s', $model->created_at)
                        . '</span>'
                        
                        . '</i></small></h4>'
                        . '<p>' . $model->text
                        . '</p>'
                        . Html::a(
                            'Удалить', 
                            ['delete', 'id' => $model->id],
                            [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Удалить отзыв?',
                                    'method' => 'post',
                                ],
                            ]
                        )
                    . '</div>'
                . '</div>';
            return $item;
        },
    ]) ?>

    <?php Pjax::end(); ?>

</div>
