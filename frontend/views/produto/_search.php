<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProdutoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-search">
    <?php $form = ActiveForm::begin(['method' => 'get']); ?>

    <div class="row">
        <div class="col-6 offset-3">
            <?= $form->field($model, 'searchstring',
                ['template' => '<div class="input-group">{input}<span class="input-group-append">' .
                    Html::submitButton('Search', ['class' => 'btn btn-default']) .
                    '</span></div>',])->textInput(['placeholder' => 'Search']);
            ?>
        </div>
    </div>
    <hr>
    
    <?php ActiveForm::end(); ?>
</div>
