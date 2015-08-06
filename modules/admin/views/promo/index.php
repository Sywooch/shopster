<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\UserContent;

$this->title = 'Акции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить акцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'content_id' => [
                'attribute' => 'content_id',
                'value' => function($data){
                    $array = ArrayHelper::map(UserContent::find()->all(), 'id', 'title');
                    if(isset($array[$data->content_id]))
                        return $array[$data->content_id];
                    else
                        return "Не указан";
                },
            ],
            'status' => [
                'attribute' => 'status',
                'filter' => [0 => "Да", 1 => "Нет"],
                'value' => function($data){
                    if($data->status)
                        return "Да";
                    else return "Нет";
                }
            ],
            'paid' => [
                'attribute' => 'paid',
                'filter' => [0 => "Да", 1 => "Нет"],
                'value' => function($data){
                    if($data->paid)
                        return "Да";
                    else return "Нет";
                }
            ],
            'image' => [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) { return Html::img($data->imageUrl,['width'=>300]); },
            ],
            'description',
            'duration',
            'created_at' => [
                'attribute' => 'created_at',
                'filter' => false,
                'value' => function($data){
                    return date("Y:m:d h:m:s", $data->created_at);
                }
            ],
            'updated_at' => [
                'attribute' => 'updated_at',
                'filter' => false,
                'value' => function($data){
                    return date("Y:m:d h:m:s", $data->updated_at);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' =>[
                    'success'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-ok"></span>', 
                            Url::to(['/admin/promo/ok-status', 'id' => $model->id])
                            , ['title' => "Одобрено"]);
                   },
                   'fail'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-minus"></span>', 
                            Url::to(['/admin/promo/nook-status', 'id' => $model->id])
                            , ['title' => "Не одобрено"]);
                   },
                ],
                'template' => '{update} {delete} {success} {fail}',
            ],
        ],
    ]); ?>

</div>
