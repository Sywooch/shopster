<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Категории магазинов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'status' => [
                'attribute' => 'status',
                'filter' => [0 => "Да", 1 => "Нет"],
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

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

</div>
