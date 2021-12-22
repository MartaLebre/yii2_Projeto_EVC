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

    <?= $form->field($model, 'searchstring',
        ['template' => '<div class="input-group">{input}<span class="input-group-append">' .
            Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-default']) .
            '</span></div>',])->textInput(['placeholder' => 'Pesquisa']);
    ?>

    <?php ActiveForm::end(); ?>
</div>
