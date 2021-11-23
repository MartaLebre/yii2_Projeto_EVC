<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FaturacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faturacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'primeiro_nome') ?>

    <?= $form->field($model, 'ultimo_nome') ?>

    <?= $form->field($model, 'localidade') ?>

    <?= $form->field($model, 'codigo_postal') ?>

    <?php // echo $form->field($model, 'nif') ?>

    <?php // echo $form->field($model, 'morada_faturacao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
