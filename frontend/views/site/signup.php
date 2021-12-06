<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\bootstrap4\Html;

$this->title = 'Signup';
?>
<style>
    .card{
        margin-top: 5%;
        margin-bottom: 10%;
    }
</style>

<div class="col-6 offset-3">
    <div class="card">
        <div class="card-body login-card-body">
            <h4 class="card-text">Registo</h4>
            <p class="card-text">Por favor preencha os seguintes campos</p>
            
            <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'form-signup']) ?>
            
            <?= $form->field($model,'username', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

            <div class="row">
                <div class="col-6">
                    <?= $form->field($model,'primeiro_nome', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputTemplate' => '{input}',
                        'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('primeiro_nome')]) ?>
                </div>
                <div class="col-6">
                    <?= $form->field($model,'ultimo_nome', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputTemplate' => '{input}',
                        'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('ultimo_nome')]) ?>
                </div>
            </div>
    
            <?= $form->field($model,'telemovel', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('telemovel')]) ?>
    
            <?= $form->field($model,'email', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
            
            <?= $form->field($model, 'password', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

            <div class="row">
                <div class="col-3 offset-9">
                    <?= Html::submitButton('Registar', ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
                </div>
            </div>
            
            <?php \yii\bootstrap4\ActiveForm::end(); ?>
        </div>
    </div>
</div>