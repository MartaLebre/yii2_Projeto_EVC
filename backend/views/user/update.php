<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelUser common\models\User */
/* @var $modelPerfil common\models\Perfil */

$this->title = 'Editar';
?>
<div class="user-update">
    <h4>Editar: <?= $modelPerfil->primeiro_nome ?> <?= $modelPerfil->ultimo_nome ?></h4>
    <p>Por favor preencha os seguintes campos</p>
    
    <div class="col-4">
        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'form-signup']) ?>
        
        <?= $form->field($modelUser,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}',
            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
            ->label(false)
            ->textInput(['placeholder' => $modelUser->getAttributeLabel('username')]) ?>
        
        <?= $form->field($modelPerfil,'primeiro_nome', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}',
            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
            ->label(false)
            ->textInput(['placeholder' => $modelPerfil->getAttributeLabel('primeiro_nome')]) ?>
        
        <?= $form->field($modelPerfil,'ultimo_nome', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}',
            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
            ->label(false)
            ->textInput(['placeholder' => $modelPerfil->getAttributeLabel('ultimo_nome')]) ?>
        
        <?= $form->field($modelPerfil,'telemovel', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}',
            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
            ->label(false)
            ->textInput(['placeholder' => $modelPerfil->getAttributeLabel('telemovel')]) ?>
        
        <?= $form->field($modelUser,'email', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}',
            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
            ->label(false)
            ->textInput(['placeholder' => $modelUser->getAttributeLabel('email')]) ?>

        <div class="row">
            <div class="col-3">
                <?= Html::submitButton('Update', ['class' => 'btn btn-primary btn-block', 'name' => 'update-button']) ?>
            </div>
        </div>
        
        <?php \yii\bootstrap4\ActiveForm::end(); ?>
    </div>
</div>
