<?php

use common\models\Produto;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $produtos Produto */

$this->title = 'Produtos';
Yii::$app->language = 'pt-PT';
$produtos = $dataProvider->getModels();
?>
<style>
    .card{
        min-height: 95%;
        max-height: 95%;
    }
    .card-img-top{
        object-fit: cover;
        opacity: .75;
    }
    .card-img-top:hover{
        opacity: 1;
    }
    .card hr{
        margin-top: 0;
        margin-bottom: 0;
    }
    .text-published{
        padding-top: 5px;
    }
    .btn-dark{
        background-color: #222;
        font-size: 14px;
        text-transform: uppercase;
    }
    .btn-dark:hover, .btn-dark:focus{
        color: #fff;
        background-color: #151515;
    }
    .sub-row{
        padding-top: 5px;
    }
    .img-overlay{
        position: absolute;
        top: 0;
        padding: 1.25rem;
    }
    .btn-desconto{
        color: #fff;
        background-color: red;
        font-size: 14px;
        text-transform: uppercase;
        padding: 3px 6px 3px 6px;
    }
    .btn-desconto:hover, .btn-desconto:focus{
        color: #fff;
    }
</style>

<div class="produto-index">
    <?= $this->render('_search', ['model' => $searchModel]) ?>
    
    <div class="row">
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="img/clothing/teste1.jpg">
                <hr>
                <div class="card-body">
                    <h6 class="card-text text-center">Vintage Reebok Jacket</h6>
                    <h6 class="card-text text-center">Large</h6>
                    <p class="card-text text-center">57.55€</p>
                    <?= Html::a('Ver Produto', ['#'], ['class' => 'btn btn-dark btn-block']) ?>
                    <div class="row sub-row">
                        <div class="col-9">
                            <p class="card-text text-published"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                        <div class="col-3">
                            <?= Html::a('<i class="far fa-heart text-danger"></i>', ['#'], ['class' => 'nav-link']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="img/clothing/teste2.jpg">
                <div class="img-overlay">
                    <button class="btn btn-desconto">DESCONTO</button>
                </div>
                <hr>
                <div class="card-body">
                    <h6 class="card-text text-center">Vintage Reebok Jacket</h6>
                    <h6 class="card-text text-center">Large</h6>
                    <p class="card-text text-center"><span style="color: grey; text-decoration: line-through; margin-right: 10px">57.55€</span>55.55€</p>
                    <?= Html::a('Ver Produto', ['#'], ['class' => 'btn btn-dark btn-block']) ?>
                    <div class="row sub-row">
                        <div class="col-9">
                            <p class="card-text text-published"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                        <div class="col-3">
                            <?= Html::a('<i class="far fa-heart text-danger"></i>', ['#'], ['class' => 'nav-link']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
        foreach($produtos as $produto){?>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="img/clothing/teste1.jpg">
                <hr>
                <div class="card-body">
                    <h6 class="card-text text-center"><?= $produto->nome ?></h6>
                    <h6 class="card-text text-center"><?= $produto->tamanho ?></h6>
                    <p class="card-text text-center"><?= $produto->preco ?>€</p>
                    <?= Html::a('Ver Produto', ['#'], ['class' => 'btn btn-dark btn-block']) ?>
                    <div class="row sub-row">
                        <div class="col-9">
                            <p class="card-text text-published"><small class="text-muted">Publicado <?= Yii::$app->formatter->asRelativeTime($produto->data) ?></small></p>
                        </div>
                        <div class="col-3">
                            <?= Html::a('<i class="far fa-heart text-danger"></i>', ['#'], ['class' => 'nav-link']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
