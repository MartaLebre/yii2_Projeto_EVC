<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model_itemcompra common\models\ItemCompra */
/* @var $model_produto common\models\Produto */

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
    <div class="row">
        <?php
        if($db_carrinho != null){
            foreach($db_carrinho as $model_itemcompra){
                $model_produto = $model_itemcompra->produto;
                echo $this->render('/produto/_form', ['model_produto' => $model_produto]);
            }
        }
        else{ ?>
            <div class="produtos-null offset-4">
                <h5>Não existem produtos no carrinho</h5>
            </div>
        <?php }?>
    </div>
</div>
