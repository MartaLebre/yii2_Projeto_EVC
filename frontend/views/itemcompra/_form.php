<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model_itemcompra common\models\ItemCompra */
/* @var $model_produto common\models\Produto */
/* @var $model_modelo common\models\Modelo */
/* @var $model_desconto common\models\Desconto */

$this->registerCssFile("@web/css/card_carrinho.css");

$model_produto = $model_itemcompra->produto;
$model_modelo = $model_produto->modelo;
$model_desconto = $model_modelo->desconto;
?>

<div class="card">
    <div class="row">
        <div class="col-4">
            <img class="img-top" src="img/clothing/teste1.jpg">
        </div>
        <div class="col-1">
            <div class="vr-card"></div>
        </div>
        <div class="col-6">
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
                        <?= Html::a('-', ['quantidade_sub', 'codigo_produto' => $model_produto->codigo_produto, 'id_encomenda' => $model_itemcompra->encomenda->id], ['class' => 'btn btn-default', 'id' => 'sub']) ?>
                    </div>
                    <p class="form-control"><?= $model_itemcompra->quantidade ?></p>
                    <div class="input-group-append">
                        <?= Html::a('+', ['quantidade_add', 'codigo_produto' => $model_produto->codigo_produto, 'id_encomenda' => $model_itemcompra->encomenda->id], ['class' => 'btn btn-default', 'id' => 'add']) ?>
                    </div>
                </div>

                <div class="row row-btn">
                    <div class="col-8">
                        <?= Html::a('Ver Produto',
                            ['produto/view', 'codigo_produto' => $model_produto->codigo_produto], ['class' => 'btn btn-dark btn-block shadow-sm']) ?>
                    </div>
                    <div class="col-2">
                        <?php if($model_produto->favorito != null) echo Html::a('<i class="fa fa-heart icon-favorito"></i>',
                            ['favorito/delete', 'id' => $model_produto->favorito->id], ['data-method' => 'post']);
                        else echo Html::a('<i class="far fa-heart icon-favorito"></i>',
                            ['favorito/create', 'codigo_produto' => $model_produto->codigo_produto]); ?>
                    </div>
                    <div class="col-2">
                        <?= Html::a('<i class="fa fa-times icon-delete"></i>',
                            ['delete', 'codigo_produto' => $model_produto->codigo_produto, 'id_encomenda' => $model_itemcompra->encomenda->id], ['data-method' => 'post']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>