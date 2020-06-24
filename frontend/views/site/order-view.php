<?php 

if (!$model || $model->status == 'Удалена') {
    echo 'Заявка не существует или удалена';
    throw new \yii\web\HttpException(404, 'Заявка не существует или удалена');
}
?>

<div class="contentzone rounded shadow">
    <div class="content-inner">
        <div class="row bg-grey d-flex align-items-center m-2 p-2 rounded">
            <i class="fab fa-orcid fa-2x p-2 color-main"></i>
            <h3 class="m-0 p-1">Заявка № <?= $model->id ?></h3>
        </div>

        <div class="row bg-grey d-flex align-items-center m-2 p-2 rounded">

            <i class="fas fa-sync-alt fa-2x p-2"></i>

                <div class="d-flex flex-column">
                    <span class="p-0"><b>Отдаете:</b> <?= $model->from_amount .' '. $model->from_currency .', Со счета: ' . $model->from_account?></span>  

                    <span class="p-0"><b>Получаете:</b> <?= $model->to_amount .' '. $model->to_currency .', На счет: ' . $model->to_account?></span>
                </div>

        </div>

        <div class="row bg-grey m-2 p-2 d-flex flex-column rounded">
            <span><i class="far fa-clock fa-lg p-2"></i><b>Время оформления: </b><?= date('Y-m-d H:i:s', $model->date) ?></span>
            <?php
                if ($model->status == 'Ошибка') {
                    echo '<div class="d-flex align-items-center">'
                            . '<i class="far fa-calendar-check fa-lg p-2"></i>'
                            . '<span class="pr-2"><b>Статус заявки:</b></span>'
                            . '<span class="text-danger">'
                            . ' Ошибка! Обратитесь к оператору.'
                            . '</span>'
                        . '</div>';                
                } elseif ($model->status == 'Выполнена') {
                    echo '<div class="d-flex align-items-center">'
                            . '<i class="far fa-calendar-check fa-lg p-2"></i>'
                            . '<span class="pr-2"><b>Статус заявки:</b></span>'
                            . '<span class="pr-2 text-success">'
                                . ' Ваша заявка выполнена!'
                            . '</span>'
                            .  '<span>'
                                . 'Благодарим за то, что воспользовались услугами нашего сервиса.'
                            . '</span>'
                            
                        . '</div>';        

                    
                } else {
                    echo '<span><i class="far fa-calendar-check fa-lg p-2"></i><b>Статус заявки: </b>'
                        . $model->status
                        . '</span>';
                }
            ?>
            <!-- <span><i class="far fa-calendar-check fa-lg p-2"></i><b>Статус заявки: </b><?= $model->status ?></span> -->
        </div>
    </div>
</div>
