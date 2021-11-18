<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProdutoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigo_produto') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'genero') ?>

    <?= $form->field($model, 'descrição') ?>

    <?= $form->field($model, 'tamanho') ?>

    <?php // echo $form->field($model, 'preço') ?>

    <?php // echo $form->field($model, 'quantidade') ?>

    <?php // echo $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'id_modelo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
