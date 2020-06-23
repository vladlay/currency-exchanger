<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Заявки', 'icon' => 'fas fa-tasks', 'url' => ['/exch-order']],
                    // ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Валюты', 'icon' => 'fas fa-dollar-sign', 'url' => ['/currency']],
                    ['label' => 'Корректировка резерва', 'icon' => 'fas fa-money', 'url' => ['/currency/correct-reserve']],
                    ['label' => 'Направления обменов', 'icon' => 'fas fa-exchange', 'url' => ['/exch-direction']],
                    ['label' => 'Отзывы', 'icon' => 'fas fa-comments', 'url' => ['/review']],
                    ['label' => 'Контакты', 'icon' => 'fas fa-book', 'url' => ['/contact']],
                    ['label' => 'Gii', 'icon' => 'fas fa-cogs', 'url' => ['/gii']],
                    ['label' => 'Фронт', 'icon' => 'fas fa-home', 'url' => 'http://diploma.net'],
                ],
            ]
        ) ?>

    </section>

</aside>
