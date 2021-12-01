<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $produto common\models\Produto */
/* @var $modelo common\models\Modelo */

$this->registerCssFile("@web/css/card.css");

$this->title = $produto->nome;
$modelo = $produto->modelo;
Yii::$app->language = 'pt-PT';
?>
<style>
    .header{
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .header p{
        margin-top: -7px;
        font-size: 14px;
        letter-spacing: 0;
        color: #6c757d;
    }
    .info p{
        text-align: center;
        margin-bottom: 5px;
    }
    .produto-btn{
        text-transform: uppercase;
    }
    .fa-heart{
        margin-left: -10px;
    }
    a span{
        padding-left: 7px;
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
                <h5><?= $modelo->modelo . ' ' . $produto->descricao ?></h5>
                <h5><?= sprintf('%.2f', $produto->preco) ?>€</h5>
                <p>Quantidade em stock: <?= $produto->quantidade ?></p>
                <hr>
            </div>
            <div class="info">
                <p>Tamanho recomendado: <?= $produto->tamanho ?></p>
                <p>Genero: <span class="text-capitalize"><?= $produto->genero ?></span></p>
                <p>Sem marcas ou manchas</p>
                <p>Pode mostrar alguns sinais de desgaste ou desbotamento</p>
                <p>ID do produto: <?= $produto->codigo_produto ?></p>
                <br>
            </div>
            <div class="produto-btn">
                <?= Html::a('Adicionar ao Carrinho', ['#'], ['class' => 'btn btn-dark btn-block']) ?>
                <?= Html::a('<i class="far fa-heart"></i><span>Adicionar aos favoritos</span>', ['#'], ['class' => 'nav-link text-danger']) ?>
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
