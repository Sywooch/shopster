<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bupy7\cropbox\Cropbox;
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin([
         'options' => ['enctype'=>'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'category')->dropDownList([1 => 'Главная', 2 => 'Магазины', 3 => 'Акций']) ?>

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

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->checkBox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
