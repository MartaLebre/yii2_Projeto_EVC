<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */

$this->title = $model->nome;
?>
<div class="produto-view">
    <div class="row">
        <div class="col-6">
            <img src="img/clothing/teste1.jpg">
        </div>
        <div class="col-4 offset-2 text-uppercase">
            <h4><?= $model->nome ?></h4>
            <h6>Codigo do produto: <?= $model->codigo_produto ?></h6>
            <h5><?= $model->preco ?>€</h5>
            <hr>
        </div>
    </div>

</div>
