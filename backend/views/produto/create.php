<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */
/* @var $form yii\bootstrap4\ActiveForm */

$this->registerCssFile("@web/css/create_form.css");

$this->title = 'Adicionar Produto';
?>

<div class="produto-create">
    <div class="col-5 offset-3">
        <div class="card">
            <div class="card-header">
                <h4><?= $this->title ?></h4>
                <p>Por favor preencha os seguintes campos</p>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'produto-form']) ?>
    
                <?= $form->field($model, 'nome', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                    ->label(false)
                    ->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('nome')]) ?>

                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model, 'genero', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'inputTemplate' => '{input}',
                            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                            ->label(false)
                            ->dropDownList([ 'feminino' => 'Feminino', 'masculino' => 'Masculino', ], ['prompt' => $model->getAttributeLabel('genero')]) ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($model, 'tamanho', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'inputTemplate' => '{input}',
                            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                            ->label(false)
                            ->dropDownList([ 'XS' => 'XS', 'S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL', ], ['prompt' => $model->getAttributeLabel('tamanho')]) ?>

                    </div>
                </div>
                
                <?= $form->field($model, 'descricao', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                    ->label(false)
                    ->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('descricao')]) ?>
                
                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model, 'preco', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'inputTemplate' => '{input}',
                            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                            ->label(false)
                            ->textInput(['placeholder' => $model->getAttributeLabel('preco')]) ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($model, 'quantidade', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'inputTemplate' => '{input}',
                            'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                            ->label(false)
                            ->textInput(['placeholder' => $model->getAttributeLabel('quantidade')]) ?>
                    </div>
                </div>
                
                <div class="text-right">
                    <?= Html::submitButton('Criar produto', ['class' => 'btn btn-dark shadow-sm']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

