<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Category;
use app\models\City;
use app\models\User;
use yii\widgets\ActiveForm;

$this->title = 'Магазины';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-content-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить магазин', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <p>
        <?= Html::a('Табличный вид', ['table'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'status' => [
                'attribute' => 'status',
                'filter' => [0 => "Ожидает", 1 => "Одобрено"],
                'value' => function($data){
                    if($data->status)
                        return "Одобрено";
                    else return "Ожидает";
                }
            ],
            'user_id' => [
                'attribute' => 'user_id',
                'value' => function($data){
                    $array = ArrayHelper::map(User::find()->all(), 'id', 'username');
                    return $array[$data->user_id];
                }
            ],
            'city_id' => [
                'attribute' => 'city_id',
                'filter' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
                'value' => function($data){
                    $array = ArrayHelper::map(City::find()->all(), 'id', 'name');
                    return $array[$data->city_id];
                }
            ],
            'category_id' => [
                'attribute' => 'category_id',
                'filter' => ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                'value' => function($data){
                    $array = ArrayHelper::map(Category::find()->all(), 'id', 'name');
                    return $array[$data->category_id];
                }
            ],
            'image' => [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) { return Html::img($data->imageUrl,['width'=>300, 'height'=>200]); },
            ],
            'phone',
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
                            Url::to(['/admin/user-content/ok-status', 'id' => $model->id])
                            , ['title' => "Одобрено"]);
                   },
                   'fail'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-minus"></span>', 
                            Url::to(['/admin/user-content/nook-status', 'id' => $model->id])
                            , ['title' => "Не одобрено"]);
                   },
                ],
                'template' => '{view} {update} {delete} {success} {fail}',
            ],
        ],
    ]); ?>

</div>