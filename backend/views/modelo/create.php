<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Modelo */
/* @var $form yii\bootstrap4\ActiveForm */

$this->registerCssFile("@web/css/create_form.css");

$this->title = 'Adicionar Modelo';
?>

<div class="modelo-create">
    <div class="col-4 offset-4">
        <div class="card">
            <div class="card-header">
                <h4><?= $this->title ?></h4>
                <p>Por favor preencha os seguintes campos</p>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'modelo-form']) ?>
    
                <?= $form->field($model, 'nome', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                    ->label(false)
                    ->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('nome')]) ?>
                
                <div class="text-right">
                    <?= Html::submitButton('Criar modelo', ['class' => 'btn btn-dark shadow-sm']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
