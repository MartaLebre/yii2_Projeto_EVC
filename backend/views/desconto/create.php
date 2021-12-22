<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Desconto */
/* @var $form yii\bootstrap4\ActiveForm */

$this->registerCssFile("@web/css/create_form.css");

$this->title = 'Create Desconto';
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
                        'options' => ['placeholder' => $model->getAttributeLabel('data_comeco')],
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
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
                        'options' => ['placeholder' => $model->getAttributeLabel('data_final')],
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
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

                <div class="row">
                    <div class="col-6 offset-6">
                        <?= Html::submitButton('Criar desconto', ['class' => 'btn btn-dark btn-block shadow-sm']) ?>
                    </div>
                </div>
                
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
