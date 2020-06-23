<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\bootstrap4\Button;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExchOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = false;
// $this->params['breadcrumbs'][] = $this->title;

$this->registerJs( <<< JS
    $(document).on('change', '#w0 input[type="checkbox"]', () => {

        if ($('#w0').yiiGridView('getSelectedRows').length != 0) {
            $('#submit-action').removeClass('disabled')
        } else {
            $('#submit-action').addClass('disabled')
        }
    })

    $(document).on('click', '#submit-action', () => {
        
        if ($('#w0').yiiGridView('getSelectedRows').length != 0 && $('#select-action').val() != 0) {
            
            let data = $('#w0').yiiGridView('getSelectedRows');

            let action = $('#select-action').val();

            $.pjax({
                url: '/exch-order/change-status',
                container: '#gridOrders',
                data: {action, data},
                scrollTo: false,
                type: 'POST'
            })
        }
    })
JS);
?>

<div class="exch-order-index">

    <?php Pjax::begin(['id' => 'gridOrders']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">

        <?php 
            // Html::dropDownList($name, $selection = null, $items = [], $options = []) ?>
        <?= Html::dropDownList('Имя', $selection = 'Действия', $items = [
            'Действия',
            'not_paid' => 'Не оплачена',
            'in_processing' => 'В обработке',
            'completed' => 'Выполнена',
            'error' => 'Ошибка',
            'deleted' => 'Удалена',
            ], $options = ['id' => 'select-action', 'class' => 'm-3 p-2 3w-25']) ?>


        <?= Button::widget([
            'label' => 'Применить',
            'options' => ['id' => 'submit-action','class' => 'btn btn-success m-3 disabled'],
        ]); ?>

    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [

            ['class' => 'yii\grid\CheckboxColumn'],

            'id',
            [
                'attribute' => 'date',
                'value' => 'date',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            [
                'label' => 'Обмен',
                'value' => fn($model) => $model->from_amount
                    . ' '
                    . $model->from_currency
                    . ' → '
                    . $model->to_amount
                    . ' '
                    . $model->to_currency
            ],
            'rate',
            'from_account',
            'to_account',
            'person',
            [
                'attribute' => 'status',
                'value' => function($model) {

                    if ($model->status == 'Удалена' || $model->status == 'Ошибка') {
                        $class = 'text-danger';
                    } elseif ($model->status == 'Выполнена') {
                        $class = 'text-success';
                    } else {
                        $class = 'text-info';
                    }
                        
                    $status = Html::a(
                        $text = $model->status, 
                        $url = Yii::$app->frontUrlManager->createUrl('/site/order-view?id=' . base64_encode(
                            base64_encode(
                                base64_encode($model->id)
                            ))), 
                        // /site/order-view?id=VDBSRlBRPT0%3D
                        $options = ['class' => $class]);

                    return $status;
                },
                'format' => 'html'
            ],
            'ip_address',
            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
