<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Faturacao */

$this->title = 'Faturação';
$this->params['breadcrumbs'][] = ['label' => 'Faturacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("@web/css/user_form.css");
?>
<div class="faturacao-create">
    <div class="col-6 offset-3">
        <div class="card update-form">
            <div class="card-body">
                <h4>Faturação:</h4>
                <p>Por favor preencha os seguintes campos:</p>
                
                <?php $form = ActiveForm::begin(['id' => 'form-faturacao']); ?>
    
                <?= $form->field($model,'localidade', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                    ->label(false)
                    ->textInput(['placeholder' => $model->getAttributeLabel('localidade')]) ?>

                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model,'primeiro_nome', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'template' => '{input}{error}'])
                            ->label(false)
                            ->textInput(['placeholder' => $model->getAttributeLabel('primeiro_nome')]) ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($model,'ultimo_nome', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'template' => '{input}{error}'])
                            ->label(true)
                            ->textInput(['placeholder' => $model->getAttributeLabel('ultimo_nome')]) ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-4">
                        <?= $form->field($model,'codigo_postal', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'template' => '{input}{error}'])
                            ->label(false)
                            ->textInput(['placeholder' => $model->getAttributeLabel('codigo_postal')]) ?>
                    </div>
                    <div class="col-8">
                        <?= $form->field($model,'nif', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'template' => '{input}{error}'])
                            ->label(false)
                            ->textInput(['placeholder' => $model->getAttributeLabel('nif')]) ?>
                    </div>
                </div>
                
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
</div>
