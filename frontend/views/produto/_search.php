<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProdutoSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .produto-search{
        padding-bottom: 15px !important;
    }
</style>

<div class="produto-search">
    <?php $form = ActiveForm::begin(['method' => 'get']); ?>

    <div class="row">
        <div class="col-4 offset-4">
            <?= $form->field($model, 'searchstring',
                ['template' => '<div class="input-group shadow-sm">{input}<span class="input-group-append">' .
                    Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-default']) .
                    '</span></div>',])->textInput(['placeholder' => 'Pesquisa aqui']);
            ?>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
