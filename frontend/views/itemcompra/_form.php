<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCompra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-compra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_produto')->textInput() ?>

    <?= $form->field($model, 'id_encomenda')->textInput() ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'preço_venda')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
