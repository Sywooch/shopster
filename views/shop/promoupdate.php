<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bupy7\cropbox\Cropbox;
use yii\helpers\ArrayHelper;
use app\models\UserContent;

$this->title = 'Акция';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="promo-form">

	    <?php $form = ActiveForm::begin([
	         'options' => ['enctype'=>'multipart/form-data'],
	    ]); ?>

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
	            $model->imageurl
	        ],
	        'originalUrl' => '/images/' . $model->image, 
	    ]); ?>

	    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

	    <?= $form->field($model, 'duration')->widget(\yii\jui\DatePicker::classname(), [
	        'language' => 'ru',
	        'dateFormat' => 'yyyy-MM-dd',
	    ]) ?>

	    <div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>
</div>
