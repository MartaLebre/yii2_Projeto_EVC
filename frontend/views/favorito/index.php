<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $favoritos common\models\Favorito */

$this->registerCssFile("@web/css/card.css");

$this->title = 'Favoritos';
Yii::$app->language = 'pt-PT';
?>

<div class="favorito-index">
    <div class="row">

        <?php foreach($favoritos as $favorito){?>
            <div class="col-3">
                <div class="card">
                    <img class="card-img-top" src="img/clothing/teste1.jpg">
                    <hr>
                    <div class="card-body">
                        <h6 class="card-text"><?= $favorito->codigoProduto->modelo->nome . ' ' . $favorito->codigoProduto->nome .
                            ' (' . $favorito->codigoProduto->tamanho . ')' ?></h6>
                        <p class="card-text"><?= sprintf('%.2f', $favorito->codigoProduto->preco) ?>€</p>
                        <?= Html::a('Ver Produto', ['produto/view', 'codigo_produto' => $favorito->codigo_produto], ['class' => 'btn btn-dark btn-block']) ?>
                        <div class="row">
                            <div class="col-9">
                                <p class="card-text text-published">Publicado <?= Yii::$app->formatter->asRelativeTime($favorito->codigoProduto->data) ?></p>
                            </div>
                            <div class="col-3">
                                <?php echo Html::a('<i class="fa fa-heart text-danger"></i>', ['/favorito/delete', 'id' => $favorito->id], ['data' => ['method' => 'post']]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</div>
