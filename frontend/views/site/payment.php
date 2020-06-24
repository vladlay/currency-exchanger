<?php 

use yii\helpers\Html;

// dd(!$model);
// dd($model->status);

if (!$model || $model->status == 'Удалена') {
    echo 'Заявка не существует или удалена';
    throw new \yii\web\HttpException(404, 'Заявка не существует или удалена');
}

$secret_id = base64_encode(
    base64_encode(
        base64_encode($model->id)
    )
);

?>


<div class="contentzone rounded shadow">
    <div class="content-inner">
        <div class="row bg-grey d-flex align-items-center m-2 p-2 rounded">
            <i class="fab fa-orcid fa-2x p-2 color-main"></i>
            <h3 class="m-0 p-1">Заявка № <?= $model->id ?></h3>
        </div>

        <div class="row bg-grey d-flex align-items-center m-2 p-2 rounded">
        
            <div class="row d-flex align-items-center m-1">
                <i class="fas fa-exclamation-circle text-danger fa-2x"></i>
                <span class="h5 m-0 pl-3">
                    Внимание!
                </span>
            </div>
            
            <div class="d-flex flex-column">
                <span class="ml-1 pl-5">
                    Данная операция производится оператором в ручном режиме и занимает от 5 до 30 минут в рабочее время (см. статус оператора).
                </span>  
            </div>

        </div>

        <div class="row bg-grey d-flex align-items-center m-2 p-2 rounded">

            <i class="fas fa-sync-alt fa-2x p-2"></i>

            <div class="d-flex flex-column">
                <span class="pl-1">Отдаете: <?= '<b>' . $model->from_amount .' '. $model->from_currency . '</b>' . ', Со счета: ' . '<b>' . $model->from_account . '</b>' ?></span>  

                <span class="pl-1">Получаете: <?= '<b>' . $model->to_amount .' '. $model->to_currency . '</b>' .', На счет: ' . '<b>' . $model->to_account . '</b>' ?></span>
            </div>

        </div>

        <div class="row bg-grey d-flex flex-column m-2 p-2 rounded">
            <div class="row d-flex align-items-center m-1">
                <i class="fas fa-question-circle fa-2x"></i>
                <span class="h5 m-0 pl-3">
                    Как оплатить:
                </span>
            </div>
            
            <div class="d-flex flex-column">
                <span class="ml-1 pl-5">
                    <span>Авторизуйтесь в платежной системе;</span><br>
                    <span>Переведите <?= '<b>' . $model->from_amount .' '. $model->from_currency . '</b>' ?> на кошелек <b>XXXXXXX</b>;</span><br>
                    <span>Нажмите на кнопку "Я оплатил заявку";</span>
                    <span>Ожидайте обработку заявки оператором.</span>
                </span>  
            </div>
        </div>

        <div class="row bg-grey m-2 p-2 d-flex flex-column rounded">
            <span><i class="far fa-clock fa-lg p-2"></i><b>Время оформления: </b><?= date('Y-m-d H:i:s', $model->date) ?></span>
            <span><i class="far fa-calendar-check fa-lg p-2"></i><b>Статус заявки: </b><?= $model->status ?></span>
        </div>
    

        <div class="d-flex justify-content-around p-2">

            <?= Html::a('Отменить заявку', ['site/delete_order', 'id' => $secret_id], ['class' => 'btn btn-danger']) ?>

            <?= Html::a('Я оплатил заявку', ['site/paid-order', 'id' => $secret_id], ['class' => 'btn btn-success']) ?>

        </div>
    </div>
</div>