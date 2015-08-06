<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;
use bupy7\cropbox\Cropbox;

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

    <div class="col-md-6">
	    <?php $form = ActiveForm::begin([
	         'options' => ['enctype'=>'multipart/form-data'],
	    ]); ?>

	    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

	    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

	    <?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name')) ?>

	 	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
    </div>
    <div class="col-md-6">
	    <?php echo $form->field($model, 'img')->widget(Cropbox::className(), [
	        'attributeCropInfo' => 'crop_info',
	        'optionsCropbox' => [
	            'boxWidth' => 600,
	            'boxHeight' => 600,
	            'cropSettings' => [
	                [
	                    'width' => 450,
	                    'height' => 300,
	                ],
	            ],
	        ],
	        'previewUrl' => [
	            $model->avatar
	        ],
	        'originalUrl' => '/images/' . $model->image, 
	    ]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
