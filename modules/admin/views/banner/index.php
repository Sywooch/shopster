<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Баннера';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить баннер', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category' => [
                'attribute' => 'category',
                'filter' => [1 => 'Главная', 2 => 'Магазины', 3 => 'Акции'],
                'value' => function($data){
                    $res = [1 => 'Главная', 2 => 'Магазины', 3 => 'Акции'];
                    return $res[$data->category];
                }
            ],
            'image' => [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) { return Html::img($data->imageUrl,['width'=>300]); },
            ],
            'link',
            'status' => [
                'attribute' => 'status',
                'filter' => [0 => 'Нет', 1 => 'Да'],
                'value' => function($data){
                    if($data->status)
                        return "Да";
                    else return "Нет";
                }
            ],
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
