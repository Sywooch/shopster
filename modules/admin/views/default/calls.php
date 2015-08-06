<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\User;

$this->title = 'Запросы пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-call-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'status' => [
                'attribute' => 'status', 
                'filter' => [0 => "Новый", 1 => "Принят", 2 => "В процессе", 3 => "Выполнен"],
                'value' => function($data){
                    $array = [0 => "Новый", 1 => "Принят", 2 => "В процессе", 3 => "Выполнен"];
                    return $array[$data->status];
                }
            ],
            'paid_status' => [
                'attribute' => 'paid_status', 
                'filter' => [0 => "Не оплачен", 1 => "Оплачен", 2 => "Не нужно оплачивать"],
                'value' => function($data){
                    $array = [0 => "Не оплачен", 1 => "Оплачен", 2 => "Не нужно оплачивать"];
                    return $array[$data->paid_status];
                }
            ],
            'type' => [
                'attribute' => 'type', 
                'filter' => [1 => "Новый магазин", 2 => "Подлючение платных услуг", 3 => "Добавление акций"],
                'value' => function($data){
                    $array = [1 => "Новый магазин", 2 => "Подлючение платных услуг", 3 => "Добавление акций"];
                    return $array[$data->type];
                }
            ],
            'user_id' => [
                'attribute' => 'user_id',
                'filter' => false,
                'value' => function($data){
                    return User::findOne($data->user_id)->username;
                }
            ],
            'created_at' => [
                'attribute' => 'created_at',
                'filter' => false,
                'value' => function($data){
                    return date("Y:m:d h:m:s", $data->created_at);
                }
            ],
            'text:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'success'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-ok"></span>', 
                            Url::to(['/admin/default/ok-status', 'id' => $model->id])
                            , ['title' => "Выполнен"]);
                   },
                   'take'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-file"></span>', 
                            Url::to(['/admin/default/take-status', 'id' => $model->id])
                            , ['title' => "Принят"]);
                   },
                   'proccess'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-repeat"></span>', 
                            Url::to(['/admin/default/proccess-status', 'id' => $model->id])
                            , ['title' => "в процессе"]);
                   },
                   'paid'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-star"></span>', 
                            Url::to(['/admin/default/paid-status', 'id' => $model->id])
                            , ['title' => "Оплачен"]);
                   },
                   'nopaid'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-star-empty"></span>', 
                            Url::to(['/admin/default/nopaid-status', 'id' => $model->id])
                            , ['title' => "Не оплачен"]);
                   }
                ],
                'template' => '{take} {proccess} {success} {paid} {nopaid} {delete}',
            ],
        ],
    ]); ?>

</div>