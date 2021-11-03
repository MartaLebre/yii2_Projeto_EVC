<?php

/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$this->title = 'Login';
?>
<br>
<div class="col-6 offset-3">
    <div class="card">
        <div class="card-body login-card-body">
            <h4>Iniciar sessão</h4>
            <p>Por favor preencha os seguintes campos</p>
            
            <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>
            
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

            <div class="row">
                <div class="col-4 offset-8">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block']) ?>
                </div>
            </div>
            
            <?php \yii\bootstrap4\ActiveForm::end(); ?>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>