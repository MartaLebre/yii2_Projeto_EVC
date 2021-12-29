<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Desconto */
/* @var $form yii\bootstrap4\ActiveForm */

$this->registerCssFile("@web/css/create_form.css");

$this->title = 'Adicionar Desconto';
?>
<div class="desconto-create">
    <div class="col-4 offset-4">
        <div class="card">
            <div class="card-header">
                <h4><?= $this->title ?></h4>
                <p>Por favor preencha os seguintes campos</p>
            </div>
            
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'desconto-form'])?>
                
                <?= $form->field($model, 'data_comeco', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                    ->label(false)
                    ->widget(DatePicker::classname(), [
                        'options' => [
                            'autocomplete' => 'off',
                            'placeholder' => $model->getAttributeLabel('data_comeco')
                        ],
                        'type' => DatePicker::TYPE_INPUT,
                        'language' => 'pt',
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy/mm/dd'
                        ]])?>
                
                <?= $form->field($model, 'data_final', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                    ->label(false)
                    ->widget(DatePicker::classname(), [
                        'options' => [
                            'autocomplete' => 'off',
                            'placeholder' => $model->getAttributeLabel('data_final')
                        ],
                        'type' => DatePicker::TYPE_INPUT,
                        'language' => 'pt',
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy/mm/dd'
                        ]])?>
                
                <?= $form->field($model, 'valor', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                    ->label(false)
                    ->textInput(['placeholder' => $model->getAttributeLabel('valor')]) ?>

                <div class="text-right">
                    <?= Html::submitButton('Criar desconto', ['class' => 'btn btn-dark shadow-sm']) ?>
                </div>
                
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
