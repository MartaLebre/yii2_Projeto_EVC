<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Faturacao */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/user_form.css");
?>
<div class="perfil-update col-6 offset-3">
    <div class="card update-form">
        <div class="card-body login-card-body">
            <h4>Faturação:</h4>
            <p>Por favor preencha os seguintes campos:</p>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model,'primeiro_nome', [
                'options' => ['class' => 'form-group has-feedback'],
                'template' => '{input}{error}'])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('primeiro_nome')]) ?>

            <div class="row">
                <div class="col-6">
                    <?= $form->field($model,'ultimo_nome', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'template' => '{input}{error}'])
                        ->label(true)
                        ->textInput(['placeholder' => $model->getAttributeLabel('ultimo_nome')]) ?>
                </div>
                <div class="col-6">
                    <?= $form->field($model,'localidade', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'template' => '{input}{error}'])
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('localidade')]) ?>
                </div>
            </div>

            <?= $form->field($model,'codigo_postal', [
                'options' => ['class' => 'form-group has-feedback'],
                'template' => '{input}{error}'])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('codigo_postal')]) ?>

            <?= $form->field($model,'nif', [
                'options' => ['class' => 'form-group has-feedback'],
                'template' => '{input}{error}'])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('nif')]) ?>

            <?= $form->field($model,'morada_faturacao', [
                'options' => ['class' => 'form-group has-feedback'],
                'template' => '{input}{error}'])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('morada_faturacao')]) ?>

            <div class="row">
                <div class="col-3 offset-9">
                    <?= Html::submitButton('Continuar', ['class' => 'btn btn-dark btn-block', 'name' => 'update-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>