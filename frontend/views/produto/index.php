<?php

use yii\helpers\Html;
use yii\bootstrap4\BootstrapAsset;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $produtos common\models\Produto */
/* @var $modelo common\models\Modelo */

$this->registerCssFile("@web/css/card.css");

$this->title = 'Produtos';
Yii::$app->language = 'pt-PT';
$modelProdutos = $dataProvider->getModels();
?>

<div class="produto-index">
    <?= $this->render('_search', ['model' => $searchModel]) ?>
    
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
                            <?= Html::a('<i class="far fa-heart text-danger"></i>', ['#']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <?php foreach($modelProdutos as $produto){
            $modelo = $produto->modelo; ?>
            <div class="col-3">
                <div class="card">
                    <img class="card-img-top" src="img/clothing/teste1.jpg">
                    <hr>
                    <div class="card-body">
                        <h6 class="card-text"><?= $modelo->modelo . ' ' . $produto->nome .
                            ' (' . $produto->tamanho . ')' ?></h6>
                        <p class="card-text"><?= sprintf('%.2f', $produto->preco) ?>€</p>
                        <?= Html::a('Ver Produto', ['produto/view', 'codigo_produto' => $produto->codigo_produto], ['class' => 'btn btn-dark btn-block']) ?>
                        <div class="row">
                            <div class="col-9">
                                <p class="card-text text-published">Publicado <?= Yii::$app->formatter->asRelativeTime($produto->data) ?></p>
                            </div>
                            <div class="col-3">
                                <?php if(!Yii::$app->user->isGuest){
                                    if($produto->favorito != null) echo Html::a('<i class="fa fa-heart text-danger"></i>', ['/favorito/delete', 'id' => $produto->favorito->id], ['data' => ['method' => 'post']]);
                                    else echo Html::a('<i class="far fa-heart text-danger"></i>', ['/favorito/create', 'codigo_produto' => $produto->codigo_produto]);
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</div>
