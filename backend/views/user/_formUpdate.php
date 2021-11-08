<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelUser common\models\User */
/* @var $modelPerfil common\models\Perfil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelUser, 'username')->textInput() ?>

    <?= $form->field($modelPerfil, 'primeiro_nome')->textInput() ?>

    <?= $form->field($modelPerfil, 'ultimo_nome')->textInput() ?>

    <?= $form->field($modelPerfil, 'telemovel')->textInput() ?>

    <?= $form->field($modelUser, 'email')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
