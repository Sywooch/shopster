<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\User;

$this->title = 'Действия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id' => [
                'attribute' => 'user_id',
                'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                'value' => function($data){
                    $array = ArrayHelper::map(User::find()->all(), 'id', 'username');
                    return $array[$data->user_id];
                }
            ],
            'action:ntext',
            'comment:ntext' => [
                'attribute' => 'comment',
                'filter' => false,
                'format' => 'html',
                'value' => function($data){
                    $da = json_decode($data->comment, true);
                    $old = $da['old'];
                    $new = $da['new'];
                    foreach ($old as $key => $value) {
                        $res = "Изменили ". $key ." с ".$old[$key]." на ". $new[$key];
                    }
                    return $res;
                }
            ],
            'created'=>[
                'attribute' => 'created',
                'filter' => false,
                'value' => function($data){
                    return date("Y:m:d h:m:s", $data->created);
                }
            ],
        ],
    ]); ?>

</div>
