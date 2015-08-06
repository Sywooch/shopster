<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Category;
use app\models\City;
use bupy7\cropbox\Cropbox;
use kartik\select2\Select2;
use dosamigos\selectize\SelectizeDropDownList;
use app\models\UserContent;

$model->shops = json_decode($model->shops);

?>

<div class="user-content-form">

    <?php $form = ActiveForm::begin([
         'options' => ['enctype'=>'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'shops')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
        'items' => $data,
        'options' => ['class' => 'form-control', 'multiple' => true],
        'clientOptions' => [
            'plugins' => ['remove_button'],
            'valueField' => 'id',
            'labelField' => 'name',
            'searchField' => ['name'],
            'create' => false,
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
