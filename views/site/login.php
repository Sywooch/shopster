<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Войти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-box" id="login-box">

    <div class="header"><?= Html::encode($this->title) ?></div>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="body bg-gray">
        <p>Заполните форму, чтобы войти:</p>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
    </div>
    <div class="footer">

        <?= Html::submitButton('Войти', ['class' => 'btn bg-olive btn-block', 'name' => 'login-button']) ?>

        <p>
            <?= Html::a('Забыл пароль', ['user/request-password-reset']) ?>
        </p>

    </div>
    <?php ActiveForm::end(); ?>
</div>