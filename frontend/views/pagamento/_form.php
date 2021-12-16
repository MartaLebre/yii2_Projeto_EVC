<?php

use nex\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pagamento */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/user_form.css");
?>
<div class="perfil-update col-6 offset-3">
    <div class="card update-form">
        <div class="card-body login-card-body">
            <h4>Pagamento:</h4>
            <p>Por favor preencha os seguintes campos:</p>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model,'numero_cartao', [
                'options' => ['class' => 'form-group has-feedback'],
                'template' => '{input}{error}'])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('numero_cartao')]) ?>

            <div class="row">
                <div class="col-6">
                    <?= $form->field($model,'data_validade', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'template' => '{input}{error}'])
                        ->label(true)
                        ->widget(DatePicker::className(), ['clientOptions' => ['format' => 'Y-M-D']])
                        ->textInput(['placeholder' => $model->getAttributeLabel('data_validade')]) ?>
                </div>
                <div class="col-6">
                    <?= $form->field($model,'codigo_segurança', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'template' => '{input}{error}'])
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('codigo_segurança')]) ?>
                </div>

                    <div class="col-3 offset-9">
                        <?= Html::submitButton('Finalizar', ['class' => 'btn btn-dark btn-block', 'name' => 'update-button']) ?>
                    </div>
            </div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

