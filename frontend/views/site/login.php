<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->registerCssFile("@web/css/user_form.css");

$this->title = 'Login';
?>

<div class="col-6 offset-3">
    <div class="card login-form">
        <div class="card-header">
            <h4><?= $this->title ?></h4>
            <p>Por favor preencha os seguintes campos</p>
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

            <?= $form->field($model, 'username', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

            <?= $form->field($model, 'password', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}<div class="input-group-append"></div>',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

            <p>Não tem uma conta? <?= Html::a('Registe-se', ['/site/signup'], ['name' => 'signin-button']) ?></p>

            <div class="text-right">
                <?= Html::submitButton('Login', ['class' => 'btn btn-dark shadow-sm', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
