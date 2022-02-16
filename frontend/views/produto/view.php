<?php

use common\widgets\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model_produto common\models\Produto */
/* @var $model_modelo common\models\Modelo */
/* @var $model_desconto common\models\Desconto */
/* @var $model_produto_sugestao common\models\Produto */

$this->registerCssFile("@web/css/card.css");
$this->registerCssFile("@web/css/view_produto.css");

$model_modelo = $model_produto->modelo;
$model_desconto = $model_modelo->desconto;

Yii::$app->language = 'pt-PT';
$this->title = $model_produto->nome;
?>

<div class="produto-view">
    <?= Alert::widget() ?>
    
    <div class="row">
        <div class="col-6 offset-1">
           <?= Html::img(Yii::$app->urlManagerFrontend->baseUrl . '/' . $model_produto->foto, ['class' => 'card-img-top']); ?>
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
                <hr>
            </div>
            <div class="info">
                <p><?= $model_produto->descricao ?></p>
                <p>Quantidade em stock: <span><?= $model_produto->quantidade ?></span></p>
                <p>Tamanho recomendado: <span><?= $model_produto->tamanho ?></span></p>
                <p>Genero: <span class="text-capitalize"><?= $model_produto->genero ?></span></p>
                <p>Sem marcas ou manchas</p>
                <p>Pode mostrar alguns sinais de desgaste ou desbotamento</p>
                <p>ID do produto: <span><?= $model_produto->codigo_produto ?></span></p>
                <br>
            </div>
            
            <?php
            if($model_produto->quantidade != 0){ ?>
            <div class="produto-btn">
                <div class="row">
                    <div class="col-9 offset-1">
                        <?php if(!Yii::$app->user->isGuest) echo Html::a('Adicionar ao Carrinho de compras', ['/encomenda/create', 'codigo_produto' => $model_produto->codigo_produto], ['class' => 'btn btn-dark btn-block shadow-sm']);
                        else echo Html::a('Adicionar ao Carrinho de compras', ['/site/login'], ['class' => 'btn btn-dark btn-block shadow-sm']);?>
                    </div>
                    <div class="col-2">
                        <?php
                        if(!Yii::$app->user->isGuest){
                            if($model_produto->favorito != null) echo Html::a('<i class="fa fa-heart icon-favorito-view"></i>', ['/favorito/delete', 'id' => $model_produto->favorito->id], ['data' => ['method' => 'post']]);
                            else echo Html::a('<i class="far fa-heart icon-favorito-view"></i>', ['/favorito/create', 'codigo_produto' => $model_produto->codigo_produto]);
                        }
                        else echo Html::a('<i class="far fa-heart icon-favorito-view"></i>', ['/site/login']); ?>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>

    <div class="produtos-sugestao">
        <hr>
        <h5 class="titulo-sugestao">Produtos semelhantes</h5>
        <div class="row">
            <?php
            foreach($db_produtos as $model_produto_sugestao){
                if($model_produto_sugestao->codigo_produto != $model_produto->codigo_produto){
                    echo $this->render('_form', ['model_produto' => $model_produto_sugestao]);
                }
            }?>
        </div>
    </div>
</div>
