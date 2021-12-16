<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model_itemcompra common\models\ItemCompra */
/* @var $model_produto common\models\Produto */

$this->registerCssFile("@web/css/index_itemcompra.css");

Yii::$app->language = 'pt-PT';
$this->title = 'Carrinho';
?>
<style>
    .produtos-null h5{
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding-bottom: 83%;
        margin-top: -5px;
    }
</style>

<div class="item-compra-index">
    <?php
    if($db_carrinho != null){?>
        <div class="row">
            <div class="col-6 offset-2">
                <?php
                foreach($db_carrinho as $model_itemcompra){
                    $model_produto = $model_itemcompra->produto; ?>
                    <div class="row" style="padding-bottom: 10px">
                        <?= $this->render('_form', ['model_produto' => $model_produto]); ?>
                    </div>
                <?php }?>
            </div>
            <div class="col-1">
                <div class="vr-index"></div>
            </div>
            <div class="col-2">
                <div class="checkout">
                    <p>Resumo</p>
                    <?php $total_encomenda = 0;
                     foreach($db_carrinho as $model_itemcompra) {
                         $model_produto = $model_itemcompra->produto;
                         $model_desconto = $model_produto->modelo->desconto;
                    if($model_desconto != null && $model_desconto->getDescontoActivo($model_desconto->id_modelo)){
                         $total_encomenda += $model_produto->preco - ($model_produto->preco * ($model_desconto->valor / 100)) ?>
                    <?php } else {
                         $total_encomenda += $model_produto->preco ?>
                    <?php }}?>
                    <p>Taxa <span>(Iva): </span><?=  sprintf('%.2f', $total_encomenda - ($total_encomenda * 0.81295)) .  '€'?> </p>

                    <h6>Total <span class="total-iva">Encomenda: </span><?=   sprintf('%.2f', $total_encomenda. '€') ?></h6>
                </div>
                    <?= Html::a('Finalizar Compra', ['faturacao/create'], ['class' => 'btn btn-dark btn-block shadow-sm']) ?>
            </div>
        </div>
    <?php }
    else{ ?>
        <div class="produtos-null offset-0">
            <h5>Não existem produtos no carrinho</h5>
        </div>
    <?php }?>
</div>