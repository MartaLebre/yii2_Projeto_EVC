<?php

/* @var $this yii\web\View */
/* @var $model_produto common\models\Produto */
/* @var $model_modelo common\models\Modelo */
/* @var $model_desconto common\models\Desconto */
/* @var $model_produto_sugestao common\models\Produto */

use yii\helpers\Html;

$this->registerCssFile("@web/css/view_produto.css");

$model_modelo = $model_produto->modelo;
$model_desconto = $model_modelo->desconto;

Yii::$app->language = 'pt-PT';
$this->title = $model_produto->nome;
?>

<div class="produto-view">
    <br>

    <div class="row">
        <div class="col-5 offset-1">
            <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/' . $model_produto->foto, ['class' => 'card-img-top']); ?>
        </div>
        <div class="col-5">
            <br>
            <div class="header">
                <?php
                if($model_desconto != null && $model_desconto->getDescontoActivo($model_desconto->id_modelo)){ ?>
                    <h5><?= $model_modelo->nome . ' ' . $model_produto->nome?></h5>

                    <h5><?= sprintf('%.2f', $model_produto->preco - ($model_produto->preco * ($model_desconto->valor / 100))) . '€'  .
                        '<span class="preco-semdesconto">' . sprintf('%.2f', $model_produto->preco) . '€</span>' .
                        '<span class="btn btn-desconto shadow-sm">-' . $model_desconto->valor . '%</span>'?></h5>
                    <p>Desconto termina <?= Yii::$app->formatter->asRelativeTime($model_desconto->data_final) ?></p>
                <?php }
                else{ ?>
                    <h5><?= $model_modelo->nome . ' ' . $model_produto->nome ?></h5>
                    <h5><?= sprintf('%.2f', $model_produto->preco) ?>€</h5>
                <?php }?>
                <p>Quantidade em stock: <?= $model_produto->quantidade ?></p>
                <hr>
            </div>
            <div class="info">
                <p><?= $model_produto->descricao ?></p>
                <p>Tamanho recomendado: <?= $model_produto->tamanho ?></p>
                <p>Genero: <span class="text-capitalize"><?= $model_produto->genero ?></span></p>
                <p>Sem marcas ou manchas</p>
                <p>Pode mostrar alguns sinais de desgaste ou desbotamento</p>
                <p>ID do produto: <?= $model_produto->codigo_produto ?></p>
                <br>
            </div>
        </div>
    </div>
</div>