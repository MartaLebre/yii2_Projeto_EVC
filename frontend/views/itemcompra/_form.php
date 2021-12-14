<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model_produto common\models\Produto */
/* @var $model_modelo common\models\Modelo */
/* @var $model_desconto common\models\Desconto */

$this->registerCssFile("@web/css/card_carrinho.css");

$model_modelo = $model_produto->modelo;
$model_desconto = $model_modelo->desconto;
?>

<div class="card">
    <div class="row">
        <div class="col-3">
            <img class="img-top" src="img/clothing/teste1.jpg">
        </div>
        <div class="col-1">
            <div class="vr-card"></div>
        </div>
        <div class="col-8">
            <div class="card-body">
                <?php
                if($model_desconto != null && $model_desconto->getDescontoActivo($model_desconto->id_modelo)){ ?>
                    <h5><?= $model_modelo->nome . ' ' . $model_produto->nome?></h5>

                    <h6><?= sprintf('%.2f', $model_produto->preco - ($model_produto->preco * ($model_desconto->valor / 100))) . '€'  .
                        '<span class="preco-semdesconto">' . sprintf('%.2f', $model_produto->preco) . '€</span>' .
                        '<span class="btn btn-desconto shadow-sm">-' . $model_desconto->valor . '%</span>'?></h6>
                <?php }
                else{ ?>
                    <h5><?= $model_modelo->nome . ' ' . $model_produto->nome ?></h5>
                    <h6 class="semdesconto"><?= sprintf('%.2f', $model_produto->preco) ?>€</h6>
                <?php }?>

                <div class="input-group update-quantidade">
                    <div class="input-group-prepend">
                        <?= Html::a('-', ['#'], ['class' => 'btn btn-default']) ?>
                    </div>
                    <p class="form-control">4</p>
                    <div class="input-group-append">
                        <?= Html::a('+', ['#'], ['class' => 'btn btn-default']) ?>
                    </div>
                </div>

                <div class="row subrow">
                    <div class="col-6">
                        <?= Html::a('Ver Produto', ['produto/view', 'codigo_produto' => $model_produto->codigo_produto], ['class' => 'btn btn-dark btn-block shadow-sm']) ?>
                    </div>
                    <div class="col-2">
                        <?php if($model_produto->favorito != null) echo Html::a('<i class="fa fa-heart icon-favorito"></i>', ['/favorito/delete', 'id' => $model_produto->favorito->id], ['data' => ['method' => 'post']]);
                        else echo Html::a('<i class="far fa-heart icon-favorito"></i>', ['/favorito/create', 'codigo_produto' => $model_produto->codigo_produto]); ?>
                    </div>
                    <div class="col-2">
                        <?= Html::a('<i class="fa fa-times icon-delete"></i>', ['/#']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>