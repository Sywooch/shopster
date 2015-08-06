<?php
use app\components\Navi;
use app\models\UserCall;
use app\models\UserContent;
use app\models\Promo;
?>
<aside class="left-side sidebar-offcanvas">

    <section class="sidebar">

        <?php if (!Yii::$app->user->isGuest) : ?>
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= @Yii::$app->user->identity->avatar ?>" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>Hello, <?= @Yii::$app->user->identity->username ?></p>
                </div>
            </div>
        <?php endif ?>
        <?php 
            $calls = UserCall::find()->where(['status' => 0])->all(); 
            $contents = UserContent::find()->where(['status' => 0])->all(); 
            $promos = Promo::find()->where(['status' => 0])->all();
        ?>
        <?=Navi::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    // [
                    //     'label' => '<span class="fa fa-camera"></span> Cameras',
                    //     'items' => [
                    //         ['label' => 'Index', 'url' => ['/admin/default']],
                    //     ],
                    // ],<i class="fa fa-spinner"></i>
                    ['label' => '<span class="fa fa-file-code-o"></span> Города', 'url' => ['/admin/city/index']],
                    ['label' => '<span class="fa fa-file-code-o"></span> Баннера', 'url' => ['/admin/banner/index']],
                    ['label' => '<span class="fa fa-file-code-o"></span> Категории', 'url' => ['/admin/category/index']],
                    ['label' => '<span class="fa fa-file-code-o"></span> Категории магазинов', 'url' => ['/admin/shop-category/index']],
                    ['label' => '<span class="fa fa-file-code-o"></span> Пользователи', 'url' => ['/admin/user/index']],
                    ['label' => '<span class="fa fa-file-code-o"></span> Магазины и тц <span class="badge">'.count($contents).'</span>', 'url' => ['/admin/user-content/index']],
                    ['label' => '<span class="fa fa-file-code-o"></span> Акции и скидки <span class="badge">'.count($promos).'</span>', 'url' => ['/admin/promo/index']],
                    ['label' => '<span class="fa fa-file-code-o"></span> Запросы пользователей <span class="badge">'.count($calls).'</span>', 'url' => ['/admin/default/calls']],
                    ['label' => '<span class="fa fa-file-code-o"></span> Лог действий', 'url' => ['/admin/log/index']],
                    ['label' => '<span class="fa fa-file-code-o"></span> Gii', 'url' => ['/gii']],
                    ['label' => '<span class="fa fa-dashboard"></span> Debug', 'url' => ['/debug']],
                ],
            ]
        );
        ?>
        

    </section>

</aside>
