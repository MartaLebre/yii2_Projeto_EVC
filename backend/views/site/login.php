<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$this->registerCssFile("@web/css/user_form.css");

$this->title = 'Login';
?>
<br>
<div class="col-6 offset-3">
    <div class="card login-form">
        <div class="card-header">
            <h4>Iniciar sessão</h4>
            <p>Por favor preencha os seguintes campos</p>
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>
            
            <?= $form->field($model,'username', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
            
            <?= $form->field($model, 'password', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
            
            <div class="text-right">
                <?= Html::submitButton('Login', ['class' => 'btn btn-dark shadow-sm']) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>