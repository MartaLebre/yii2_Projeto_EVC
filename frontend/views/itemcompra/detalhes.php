<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model_encomenda common\models\Encomenda */
/* @var $model_itemcompra common\models\ItemCompra */
/* @var $model_faturacao common\models\Faturacao */
/* @var $model_pagamento common\models\Pagamento */

$this->registerCssFile("@web/css/detalhes.css");

Yii::$app->language = 'pt-PT';
$this->title = 'Encomenda #' . $model_encomenda->id;
?>

<br>
<div class="encomenda-detalhes">
    <?php
    if($models_itemcompra != null){?>
        <div class="row">
            <div class="col-5 offset-2">
                <h6 class="encomenda-status">Encomenda #<?= $model_encomenda->id . ' / ' . $model_encomenda->estado ?></h6>
                <?php
                foreach($models_itemcompra as $model_itemcompra){ ?>
                    <div class="row row-form">
                        <?= $this->render('_formdetalhes', ['model_itemcompra' => $model_itemcompra]); ?>
                    </div>
                <?php }?>
            </div>
            <div class="col-1 col-hr">
                <div class="vr-index"></div>
            </div>
            <div class="col-4">
                <div class="checkout">
                    <h5>Faturação</h5>
                    <h6>Nome: <span><?= $model_faturacao->primeiro_nome . ' ' . $model_faturacao->ultimo_nome ?></span></h6>
                    <h6>Localidade: <span><?= $model_faturacao->localidade ?></span></h6>
                    <h6>Codigo Postal: <span><?= $model_faturacao->codigo_postal ?></span></h6>
                    <h6>Morada de faturação: <span><?= $model_faturacao->morada_faturacao ?></span></h6>
                    <h6>NIF: <span><?= $model_faturacao->nif ?></span></h6>
                    <br>

                    <h5>Pagamento</h5>
                    <h6>Número do cartão: <span>**** **** **** <?= substr($model_pagamento->numero_cartao, -4) ?></span></h6>
                    <h6>Data de validade: <span><?= $model_pagamento->data_validade ?></span></h6>
                    <br>

                    <h5>Resumo</h5>
                    <?php
                    $total_encomenda = 0;
                    foreach($models_itemcompra as $model_itemcompra){
                        $total_encomenda += ($model_itemcompra->preco_venda *  $model_itemcompra->quantidade);
                    }?>
                    <h6>Taxa (Iva): <span><?= sprintf('%.2f', $total_encomenda - ($total_encomenda * 0.81295)) . '€'?></span></h6>

                    <h6>Total Encomenda: <span><?= sprintf('%.2f', $total_encomenda) ?>€</span></h6>
                </div>
            </div>
        </div>
    <?php }
    else { ?>
        <div class="produtos-null">
            <h5>Não existem produtos no carrinho</h5>
        </div>
    <?php } ?>
</div>