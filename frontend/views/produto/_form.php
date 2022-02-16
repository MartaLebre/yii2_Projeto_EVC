<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model_produto common\models\Produto */
/* @var $model_modelo common\models\Modelo */
/* @var $model_desconto common\models\Desconto */

$this->registerCssFile("@web/css/card.css");

$model_modelo = $model_produto->modelo;
$model_desconto = $model_modelo->desconto;
$model_user = \common\models\User::findOne(Yii::$app->user->getId());
?>
<div class="col-3">
    <div class="card">
        <?php if($model_produto->foto != null) { ?>
            <?= Html::img(Yii::$app->urlManagerFrontend->baseUrl . '/' . $model_produto->foto, ['class' => 'card-img-top']); ?>
        <?php }
        else{ ?>
           <img src="img/clothing/teste1.jpg">
        <?php } ?>
        <?php if($model_desconto != null && $model_desconto->getDescontoActivo($model_desconto->id_modelo)){ ?>
            <div class="img-overlay">
                <p class="btn btn-desconto shadow-sm">-<?= $model_desconto->valor ?>%</p>
            </div>
        <?php }?>
        <hr>
        <div class="card-body">
            <h5 class="card-text"><?= $model_modelo->nome . ' ' . $model_produto->nome?></h5>
            <?php
            if($model_desconto != null && $model_desconto->getDescontoActivo($model_desconto->id_modelo)){ ?>
                <h6 class="card-text"><?= sprintf('%.2f', $model_produto->preco - ($model_produto->preco * ($model_desconto->valor / 100))) . '€' .
                    '<span class="preco-semdesconto">' . sprintf('%.2f', $model_produto->preco) . '€</span>'?></h5></h6>
            <?php }
            else{ ?>
                <h6 class="card-text"><?= sprintf('%.2f', $model_produto->preco) ?>€</h6>
            <?php }?>
            <?= Html::a('Ver Produto',
                ['produto/view', 'codigo_produto' => $model_produto->codigo_produto], ['class' => 'btn btn-dark btn-block shadow-sm', 'id' => $model_produto->codigo_produto]) ?>
            <div class="row">
                <div class="col-9">
                    <p class="card-text text-publicado">Publicado <?= Yii::$app->formatter->asRelativeTime($model_produto->data) ?></p>
                </div>
                <div class="col-3">
                    <?php
                    if(!Yii::$app->user->isGuest){
                        if($model_produto->favorito['id_user'] == Yii::$app->user->getId()) echo Html::a('<i class="fa fa-heart icon-favorito"></i>',
                            ['favorito/delete', 'id' => $model_produto->favorito->id], ['data-method' => 'post']);
                        else echo Html::a('<i class="far fa-heart icon-favorito"></i>',
                            ['favorito/create', 'codigo_produto' => $model_produto->codigo_produto], ['id' => 'fav']);
                    }
                    else echo Html::a('<i class="far fa-heart icon-favorito"></i>', ['site/login'], ['id' => 'fav2']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
