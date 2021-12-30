<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelUser common\models\User */
/* @var $modelPerfil common\models\Perfil */
/* @var $form yii\bootstrap4\ActiveForm */

$this->registerCssFile("@web/css/create_form.css");

$this->title = 'Editar';
?>
<div class="user-update">
    <div class="col-5 offset-3">
        <div class="card">
            <div class="card-header">
                <h4><?= $this->title ?></h4>
                <p>Por favor preencha os seguintes campos</p>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'produto-form']) ?>
                
                <?= $form->field($modelUser,'username', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                    ->label(false)
                    ->textInput(['placeholder' => $modelUser->getAttributeLabel('username')]) ?>

                <div class="row">
                    <div class="col-6">
                        <?= $form->field($modelPerfil,'primeiro_nome', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'inputTemplate' => '{input}',
                            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                            ->label(false)
                            ->textInput(['placeholder' => $modelPerfil->getAttributeLabel('primeiro_nome')]) ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($modelPerfil,'ultimo_nome', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'inputTemplate' => '{input}',
                            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                            ->label(false)
                            ->textInput(['placeholder' => $modelPerfil->getAttributeLabel('ultimo_nome')]) ?>
                    </div>
                </div>
                
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
                
                <div class="text-right">
                    <?= Html::submitButton('Atualizar', ['class' => 'btn btn-dark shadow-sm']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
