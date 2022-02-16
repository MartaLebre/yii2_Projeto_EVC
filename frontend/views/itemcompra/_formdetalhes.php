<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model_itemcompra common\models\ItemCompra */
/* @var $model_produto common\models\Produto */
/* @var $model_modelo common\models\Modelo */

$this->registerCssFile("@web/css/card_carrinho.css");

$model_produto = $model_itemcompra->produto;
$model_modelo = $model_produto->modelo;
?>

<div class="card">
    <div class="row">
        <div class="col-4">
            <?php if($model_produto->foto != null) { ?>
                <?= Html::img(Yii::$app->urlManagerFrontend->baseUrl . '/' . $model_produto->foto, ['class' => 'card-img-top']); ?>
            <?php }
            else{ ?>
                <img src="img/clothing/teste1.jpg">
            <?php } ?>
        </div>
        <div class="col-1">
            <div class="vr-card"></div>
        </div>
        <div class="col-6">
            <div class="card-body">
                <h5><?= $model_modelo->nome . ' ' . $model_produto->nome ?></h5>
                <h6>Preço de venda: <span><?= sprintf('%.2f', $model_itemcompra->preco_venda) ?>€</span></h6>
                <h6>Quantidade: <span><?= $model_itemcompra->quantidade ?></span></h6>

                <div class="row row-btn">
                    <div class="col-8">
                        <?= Html::a('Ver Produto',
                            ['produto/view', 'codigo_produto' => $model_produto->codigo_produto], ['class' => 'btn btn-dark btn-block shadow-sm']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>