<?php

use common\widgets\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model_produto common\models\Produto */
/* @var $model_modelo common\models\Modelo */
/* @var $model_desconto common\models\Desconto */
/* @var $model_produto_sugestao common\models\Produto */
/* @var $model_modelo_sugestao common\models\Modelo */
/* @var $model_desconto_sugestao common\models\Desconto */

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
    <?= Alert::widget() ?>
    
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
                <?php
                if(!Yii::$app->user->isGuest){
                    if($model_produto->favorito != null) echo Html::a('<i class="fa fa-heart icon-favorito-view"></i><span>Remover</span>', ['/favorito/delete', 'id' => $model_produto->favorito->id], ['data' => ['method' => 'post']]);
                    else echo Html::a('<i class="far fa-heart icon-favorito-view"></i><span>Favoritos</span>', ['/favorito/create', 'codigo_produto' => $model_produto->codigo_produto]);
                }
                else echo Html::a('<i class="far fa-heart icon-favorito-view"></i><span>Favoritos</span>', ['/site/login']); ?>
            </div>
            
            <?php /*
            <div class="qrcode">
                <h6>Abre na nossa aplicação</h6>
                <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?= $model_produto->codigo_produto ?>">
            </div>
            */?>
        </div>
    </div>
    <hr>
    
    <h5 class="text-center" style="padding-top: 20px; padding-bottom: 20px">Tambem pode gostar</h5>
    <div class="row">
        <?php
        foreach($db_produtos as $model_produto_sugestao){
            $model_modelo_sugestao = $model_produto_sugestao->modelo;
            $model_desconto_sugestao = $model_modelo_sugestao->desconto;
            ?>
            <div class="col-3">
                <div class="card">
                    <img class="card-img-top" src="img/clothing/teste1.jpg">
                    <?php if($model_desconto_sugestao != null){ ?>
                        <div class="img-overlay">
                            <p class="btn btn-desconto shadow-sm">-<?= $model_desconto->valor ?><i class="fa fa-percent icon-percentagem"></i></p>
                        </div>
                    <?php }?>
                    <hr>
                    <div class="card-body">
                        <h6 class="card-text"><?= $model_modelo_sugestao->nome . ' ' . $model_produto_sugestao->nome .
                            ' (' . $model_produto_sugestao->tamanho . ')' ?></h6>
                        <?php if($model_desconto_sugestao != null){ ?>
                            <p class="card-text"><?= '<span class="preco-semdesconto">' . sprintf('%.2f', $model_produto_sugestao->preco) . '€</span>' .
                                sprintf('%.2f', $model_produto_sugestao->preco - ($model_produto_sugestao->preco * ($model_desconto_sugestao->valor / 100))) ?>€</h5></p>
                        <?php }
                        else{ ?>
                            <p class="card-text"><?= sprintf('%.2f', $model_produto_sugestao->preco) ?>€</p>
                        <?php }?>
                        <?= Html::a('Ver Produto', ['produto/view', 'codigo_produto' => $model_produto_sugestao->codigo_produto], ['class' => 'btn btn-dark btn-block']) ?>
                        <div class="row">
                            <div class="col-9">
                                <p class="card-text text-publicado">Publicado <?= Yii::$app->formatter->asRelativeTime($model_produto_sugestao->data) ?></p>
                            </div>
                            <div class="col-3">
                                <?php
                                if(!Yii::$app->user->isGuest){
                                    if($model_produto_sugestao->favorito != null) echo Html::a('<i class="fa fa-heart icon-favorito"></i>', ['/favorito/delete', 'id' => $model_produto_sugestao->favorito->id], ['data' => ['method' => 'post']]);
                                    else echo Html::a('<i class="far fa-heart icon-favorito"></i>', ['/favorito/create', 'codigo_produto' => $model_produto_sugestao->codigo_produto]);
                                }
                                else echo Html::a('<i class="far fa-heart icon-favorito"></i>', ['/site/login']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</div>
