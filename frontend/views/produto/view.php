<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model_produto common\models\Produto */
/* @var $model_modelo common\models\Modelo */
/* @var $model_desconto common\models\Desconto */

$this->registerCssFile("@web/css/card.css");
$this->registerCssFile("@web/css/view_produto.css");

$model_modelo = $model_produto->modelo;
$model_desconto = $model_modelo->desconto;

Yii::$app->language = 'pt-PT';
$this->title = $model_produto->nome;
?>
<style>
    .btn-desconto{
        margin-bottom: 2px;
        margin-left: 7px;
    }
</style>

<div class="produto-view">
    <div class="row">
        <div class="col-6 offset-1">
            <img src="img/clothing/teste1.jpg">
        </div>
        <div class="col-5">
            <br>
            <div class="header">
                <?php
                if($model_desconto != null){ ?>
                    <h5><?= $model_modelo->nome . ' ' . $model_produto->descricao .
                        '<span class="btn btn-desconto shadow-sm">-' . $model_desconto->valor .
                        '<i class="fa fa-percent icon-percentagem"></i></span>'?></h5>

                    <h5><?= '<span class="preco-semdesconto">' . sprintf('%.2f', $model_produto->preco) . '€</span>' .
                        sprintf('%.2f', $model_produto->preco - ($model_produto->preco * ($model_desconto->valor / 100))) ?>€</h5>
                <?php }
                else{ ?>
                    <h5><?= $model_modelo->nome . ' ' . $model_produto->descricao ?></h5>
                    <h5><?= sprintf('%.2f', $model_produto->preco) ?>€</h5>
                <?php }?>
                <p>Quantidade em stock: <?= $model_produto->quantidade ?></p>
                <hr>
            </div>
            <div class="info">
                <p>Tamanho recomendado: <?= $model_produto->tamanho ?></p>
                <p>Genero: <span class="text-capitalize"><?= $model_produto->genero ?></span></p>
                <p>Sem marcas ou manchas</p>
                <p>Pode mostrar alguns sinais de desgaste ou desbotamento</p>
                <p>ID do produto: <?= $model_produto->codigo_produto ?></p>
                <br>
            </div>
            <div class="produto-btn">
                <?= Html::a('Adicionar ao Carrinho', ['#'], ['class' => 'btn btn-dark btn-block shadow-sm']) ?>
                <?php if(!Yii::$app->user->isGuest){
                    if($model_produto->favorito != null) echo Html::a('<i class="fa fa-heart text-danger"></i><span>Remover dos favoritos</span>', ['/favorito/delete', 'id' => $model_produto->favorito->id], ['data' => ['method' => 'post']]);
                    else echo Html::a('<i class="far fa-heart text-danger"></i><span>Adicionar aos favoritos</span>', ['/favorito/create', 'codigo_produto' => $model_produto->codigo_produto]);
                }
                else echo Html::a('<i class="far fa-heart icon-favorito"></i><span>Adicionar aos favoritos</span>', ['/site/login']); ?>
            </div>
            <div class="qrcode">
                <h6>Abre na nossa aplicação</h6>
                <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?= $model_produto->codigo_produto ?>">
            </div>
        </div>
    </div>
    <hr>
    
    <h5 class="text-center" style="padding-top: 20px; padding-bottom: 20px">Tambem pode gostar</h5>
    <div class="row">
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="img/clothing/teste2.jpg">
                <div class="img-overlay">
                    <button class="btn btn-desconto">DESCONTO</button>
                </div>
                <hr>
                <div class="card-body">
                    <h6 class="card-text">Modelo Vintage Reebok Jacket (L)</h6>
                    <p class="card-text"><span class="preco-desconto">57.55€</span>55.55€</p>
                    <?= Html::a('Ver Produto', ['#'], ['class' => 'btn btn-dark btn-block']) ?>
                    <div class="row">
                        <div class="col-9">
                            <p class="card-text text-published">Last updated 3 mins ago</p>
                        </div>
                        <div class="col-3">
                            <?= Html::a('<i class="far fa-heart text-danger"></i>', ['#'], ['class' => 'nav-link']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
