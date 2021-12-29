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

<div class="item-compra-index">
    <?php
    if($db_carrinho != null){?>
        <div class="row">
            <div class="col-5 offset-3">
                <?php
                foreach($db_carrinho as $model_itemcompra){ ?>
                    <div class="row row-form">
                        <?= $this->render('_form', ['model_itemcompra' => $model_itemcompra]); ?>
                    </div>
                <?php }?>
            </div>
            <div class="col-1 col-hr">
                <div class="vr-index"></div>
            </div>
            <div class="col-2">
                <div class="checkout">
                    <h5>Resumo</h5>
                    <?php
                    $total_encomenda = 0;
                    foreach($db_carrinho as $model_itemcompra) {
                        $model_produto = $model_itemcompra->produto;
                        $model_desconto = $model_produto->modelo->desconto
                        ;
                        if($model_desconto != null && $model_desconto->getDescontoActivo($model_desconto->id_modelo)){
                            $total_encomenda += (($model_produto->preco  - ($model_produto->preco * ($model_desconto->valor / 100))) * $model_itemcompra->quantidade) ?>
                        <?php }
                        else {
                            $total_encomenda += ($model_produto->preco *  $model_itemcompra->quantidade)?>
                        <?php }


                    }?>
                    <h6 class="taxa-iva">Taxa (Iva): <?= sprintf('%.2f', $total_encomenda - ($total_encomenda * 0.81295)) .  '€'?> </h6>

                        <h6>Total Encomenda: <?= sprintf('%.2f', $total_encomenda) ?>€</h6>
                </div>
                    <?= Html::a('Finalizar Compra', ['faturacao/create'], ['class' => 'btn btn-dark btn-block shadow-sm']) ?>
            </div>
        </div>
    <?php }
    else { ?>
        <div class="produtos-null">
            <h5>Não existem produtos no carrinho</h5>
        </div>
    <?php } ?>
</div>