<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Category;

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            'status' => [
                'attribute' => 'status',
                'filter' => [0 => 'Не Активен', 1 => 'Активен'],
                'value' => function($data){
                    if($data->status)
                        return "Активен";
                    else return "Не активен";
                }
            ],
            'image' => [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) { return Html::img($data->avatar,['width'=>300]); },
            ],
            'type' =>[
                'attribute' => 'type',
                'filter' => ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                'value' => function($data){
                    $array = ArrayHelper::map(Category::find()->all(), 'id', 'name');
                    return $array[$data->type];
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
