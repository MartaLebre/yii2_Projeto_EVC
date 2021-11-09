<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Adicionar Gestor de Stock';
?>
<div class="user-create">
    <h4>Registe um gestor de stock</h4>
    <p>Por favor preencha os seguintes campos</p>

    <div class="col-4">
        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'form-signup']) ?>
        
        <?= $form->field($model,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}',
            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
        
        <?= $form->field($model,'primeiro_nome', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}',
            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('primeiro_nome')]) ?>
        
        <?= $form->field($model,'ultimo_nome', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}',
            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('ultimo_nome')]) ?>
        
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
            <div class="col-3">
                <?= Html::submitButton('Registar', ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
            </div>
        </div>
        
        <?php \yii\bootstrap4\ActiveForm::end(); ?>
    </div>
</div>
