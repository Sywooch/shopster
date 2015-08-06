<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Category;
use app\models\City;
use bupy7\cropbox\Cropbox;
use kartik\select2\Select2;

?>

<div class="user-content-form">

    <?php $form = ActiveForm::begin([
         'options' => ['enctype'=>'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

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

    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+7 (999) 99-99-999']) ?>

    <?php echo $form->field($model, 'banner_img')->widget(Cropbox::className(), [
        'attributeCropInfo' => 'banner_crop_info',
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
            $model->bannerurl,
        ],
        'originalUrl' => '/images/' . $model->banner, 
    ]); ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'working_hours')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
