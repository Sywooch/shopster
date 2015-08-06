<?php
use app\components\Navi;
use yii\helpers\Url;
use app\models\User;
use app\models\UserContent;
?>
<aside class="left-side sidebar-offcanvas collapse-left">

    <section class="sidebar">

        <?php if (!Yii::$app->user->isGuest) : ?>
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= @Yii::$app->user->identity->avatar ?>" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>Hello, <?= @Yii::$app->user->identity->username ?></p>
                    <a href="<?= $directoryAsset ?>/#">
                        <i class="fa fa-circle text-success"></i> Online
                    </a>
                </div>
            </div>
        <?php endif ?>
        <ul class="sidebar-menu">
            <li>
                <a href="<?=Url::to(['/shop/index'])?>">
                    <i class="fa fa-th"></i> <span>Мои приложения</span>
                </a>
            </li>
            <?php 
                $cotentns = UserContent::find()->where(['user_id' => \Yii::$app->user->identity->id])->all();
                foreach ($cotentns as $content):
            ?>
                <?php if($content->category_id == 2): ?>
                    <li>
                        <a href="<?=Url::to(['/shop/add', 'id' => $content->id])?>">
                            <i class="fa fa-globe"></i> <span>Указать магазины внутри тц. для <?=$content->title?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="<?=Url::to(['/shop/geo', 'id' => $content->id])?>">
                        <i class="fa fa-map-marker"></i> <span>Указать место на карте<br> и внутри для <?=$content->title?></span>
                    </a>
                </li>
                <li><a href="<?=Url::to(['/shop/feature', 'id' => $content->id])?>"><i class="fa fa-angle-double-right"></i> Расширенные услуги</a></li>
                <li><a href="<?=Url::to(['/shop/action', 'id' => $content->id])?>"><i class="fa fa-angle-double-right"></i> Акции и скидки</a></li>
            <?php endforeach; ?>
        </ul>

    </section>

</aside>
