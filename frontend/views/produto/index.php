<?php

use common\widgets\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model_produto common\models\Produto */
/* @var $model_modelo common\models\Modelo */

$this->registerCssFile("@web/css/card.css");

$db_produtos = $dataProvider->getModels();

Yii::$app->language = 'pt-PT';
$this->title = 'Produtos';
?>

<div class="produto-index">
    <?= Alert::widget() ?>
    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <div class="row">
        <?php
        foreach($db_produtos as $model_produto){
            $model_modelo = $model_produto->modelo;
            $model_desconto = $model_modelo->desconto;
            ?>
            <div class="col-3">
                <div class="card">
                    <img class="card-img-top" src="img/clothing/teste1.jpg">
                    <?php if($model_desconto != null){ ?>
                        <div class="img-overlay">
                            <p class="btn btn-desconto shadow-sm">-<?= $model_desconto->valor ?><i class="fa fa-percent icon-percentagem"></i></p>
                        </div>
                    <?php }?>
                    <hr>
                    <div class="card-body">
                        <h6 class="card-text"><?= $model_modelo->nome . ' ' . $model_produto->nome .
                            ' (' . $model_produto->tamanho . ')' ?></h6>
                        <?php
                        if($model_desconto != null){ ?>
                            <p class="card-text"><?= '<span class="preco-semdesconto">' . sprintf('%.2f', $model_produto->preco) . '€</span>' .
                                sprintf('%.2f', $model_produto->preco - ($model_produto->preco * ($model_desconto->valor / 100))) ?>€</h5></p>
                        <?php }
                        else{ ?>
                            <p class="card-text"><?= sprintf('%.2f', $model_produto->preco) ?>€</p>
                        <?php }?>
                        <?= Html::a('Ver Produto', ['produto/view', 'codigo_produto' => $model_produto->codigo_produto], ['class' => 'btn btn-dark btn-block']) ?>
                        <div class="row">
                            <div class="col-9">
                                <p class="card-text text-publicado">Publicado <?= Yii::$app->formatter->asRelativeTime($model_produto->data) ?></p>
                            </div>
                            <div class="col-3">
                                <?php
                                if(!Yii::$app->user->isGuest){
                                    if($model_produto->favorito != null) echo Html::a('<i class="fa fa-heart icon-favorito"></i>', ['/favorito/delete', 'id' => $model_produto->favorito->id], ['data' => ['method' => 'post']]);
                                    else echo Html::a('<i class="far fa-heart icon-favorito"></i>', ['/favorito/create', 'codigo_produto' => $model_produto->codigo_produto]);
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
