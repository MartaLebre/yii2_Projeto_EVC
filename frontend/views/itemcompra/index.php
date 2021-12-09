<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ItemCompraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$db_produtosCarrinho = $dataProvider->getModels();

$this->title = 'Item Compras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-compra-index">

    <div class="row">
        <?php
        foreach($db_produtosCarrinho as $model_carrinho){
            $model_produto = $model_carrinho->codigoProduto;
            echo $this->render('/produto/_form', ['model_produto' => $model_produto]);
        }?>
    </div>


</div>
