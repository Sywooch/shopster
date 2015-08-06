<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Category;
use app\models\City;
use app\models\User;
use yii\helpers\Url;
use app\models\UserCall;

$this->title = 'Мои магазины';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-content-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
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
                'template' => '{update} {view}',
            ],
        ],
    ]); ?>

    <?php 
        $call = UserCall::find()->where(['user_id' => \Yii::$app->user->identity->id, 'type' => 1])->one();
        if(empty($call)): ?>
        <h4>
            <a href="<?=Url::to(['/shop/call-back'])?>" class="btn btn-success">Отправить запрос на добавление магазина</a>
        </h4>
    <?php else: ?>
        <?php if($call->status == 0): ?>
            <div class="alert alert-danger" role="alert">Ваш запрос обрабатывается</div>
        <?php endif; ?>
    <?php endif; ?>

</div>
