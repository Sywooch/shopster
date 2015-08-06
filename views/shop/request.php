<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Category;
use app\models\City;
use app\models\User;
use yii\helpers\Url;
use app\models\UserCall;

$this->title = 'Запрос';
$this->params['breadcrumbs'][] = $this->title;
$call = UserCall::find()->where(['user_id' => \Yii::$app->user->identity->id, 'user_content_id' => $id, 'type' => 2])->one();
if(empty($call)): ?>
	<h4>
	    <a href="<?=Url::to(['/shop/call-feature', 'id' => $id])?>" class="btn btn-success">Отправить запрос на расширенные услуги</a>
	</h4>
<?php else: ?>
    <div class="alert alert-danger" role="alert">Ваш запрос обрабатывается</div>
<?php endif; ?>