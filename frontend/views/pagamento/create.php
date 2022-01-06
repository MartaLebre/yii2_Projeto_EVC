<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Pagamento */
/* @var $form yii\bootstrap4\ActiveForm */

$this->title = 'Pagamento';

$this->registerCssFile("@web/css/user_form.css");
?>
<div class="perfil-update col-6 offset-3">
    <div class="card update-form">
        <div class="card-body login-card-body">
            <h4>Pagamento:</h4>
            <p>Por favor preencha os seguintes campos:</p>
            
            <?php $form = ActiveForm::begin(['id' => 'pagamento-form'])?>
            
            <?= $form->field($model,'numero_cartao', [
                'options' => ['class' => 'form-group has-feedback'],
                'template' => '{input}{error}'])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('numero_cartao')]) ?>

            <div class="row">
                <div class="col-6">
                    <?= $form->field($model,'data_validade', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputTemplate' => '{input}',
                        'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                        ->label(false)
                        ->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => $model->getAttributeLabel('data_validade')],
                            'type' => DatePicker::TYPE_INPUT,
                            'language' => 'pt',
                            'removeButton' => false,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy/mm/dd'
                            ]])?>

                </div>
                <div class="col-6">
                    <?= $form->field($model,'codigo_seguranca', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'template' => '{input}{error}'])
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('codigo_seguranca')]) ?>
                </div>
            </div>
            
            <div class="text-right">
                <?= Html::submitButton('Finalizar', ['class' => 'btn btn-dark', 'name' => 'update-button']) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


