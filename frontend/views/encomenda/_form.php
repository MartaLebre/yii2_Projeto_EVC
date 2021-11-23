<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Encomenda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encomenda-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'carrinho' => 'Carrinho', 'pendente' => 'Pendente', 'em processamento' => 'Em processamento', 'enviado' => 'Enviado', 'entregue' => 'Entregue', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
