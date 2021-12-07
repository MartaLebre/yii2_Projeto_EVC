<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use nex\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Desconto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="desconto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_começo')->widget(DatePicker::className(), ['clientOptions' => ['format' => 'Y-M-D']]) ?>

    <?= $form->field($model, 'data_final')->widget(DatePicker::className(), ['clientOptions' => ['format' => 'Y-M-D']])?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
