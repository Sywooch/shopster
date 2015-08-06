<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;
use bupy7\cropbox\Cropbox;

?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
         'options' => ['enctype'=>'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>
    <?php if(!$model->isNewRecord): ?>
        <?= $form->field($model, 'changePass')->checkbox(); ?>
    <?php endif; ?>
    
    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

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

    <?= $form->field($model, 'status')->dropDownList([0 => 'Не активен', 1 => 'Активен']) ?>

    <?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
