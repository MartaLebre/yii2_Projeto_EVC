<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produtos';
?>
<style>
    .card{
        min-height: 95%;
        max-height: 95%;
    }
    .card-img-top{
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
</style>

<div class="produto-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="img/clothing/teste1.jpg">
                <hr>
                <div class="card-body">
                    <h6 class="card-text text-center">Vintage Reebok Jacket Large</h6>
                    <p class="card-text text-center">57.55€</p    >
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
                <hr>
                <div class="card-body">
                    <h6 class="card-text text-center">Vintage Reebok Jacket Large</h6>
                    <p class="card-text text-center">57.55€</p    >
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
    </div>
</div>
