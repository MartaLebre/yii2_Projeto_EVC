<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCompraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-compra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigo_produto') ?>

    <?= $form->field($model, 'id_encomenda') ?>

    <?= $form->field($model, 'quantidade') ?>

    <?= $form->field($model, 'preço_venda') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
