<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model_user common\models\User */
/* @var $model_perfil common\models\Perfil */

$this->registerCssFile("@web/css/user_form.css");

$this->title = 'Editar';
?>

<br>
<div class="perfil-update col-6 offset-3">
    <div class="card update-form">
        <div class="card-body">
            <h4>Perfil</h4>
            <p>Por favor preencha os seguintes campos</p>
            
            <?php $form = ActiveForm::begin(['id' => 'form-signup']) ?>
            
            <?= $form->field($model_user,'username', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->textInput(['placeholder' => $model_user->getAttributeLabel('username')]) ?>

            <div class="row">
                <div class="col-6">
                    <?= $form->field($model_perfil,'primeiro_nome', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputTemplate' => '{input}',
                        'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                        ->label(true)
                        ->textInput(['placeholder' => $model_perfil->getAttributeLabel('primeiro_nome')]) ?>
                </div>
                <div class="col-6">
                    <?= $form->field($model_perfil,'ultimo_nome', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputTemplate' => '{input}',
                        'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                        ->label(false)
                        ->textInput(['placeholder' => $model_perfil->getAttributeLabel('ultimo_nome')]) ?>
                </div>
            </div>
            
            <?= $form->field($model_perfil,'telemovel', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->textInput(['placeholder' => $model_perfil->getAttributeLabel('telemovel')]) ?>
            
            <?= $form->field($model_user,'email', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->textInput(['placeholder' => $model_user->getAttributeLabel('email')]) ?>

            <div class="row">
                <div class="col-5 offset-4">
                    <?= Html::a('Minhas Encomendas', ['encomenda/index'], ['class' => 'btn btn-dark btn-block shadow-sm']) ?>
                </div>
                <div class="col-3">
                    <?= Html::submitButton('Atualizar', ['class' => 'btn btn-dark btn-block shadow-sm', 'name' => 'update-button']) ?>
                </div>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
