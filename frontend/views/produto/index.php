<?php

use common\models\Desconto;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model_produto common\models\Produto */

if($dataProvider != null){
    $db_produtos = $dataProvider->getModels();
}

$this->registerCssFile("@web/css/index_produto.css");

Yii::$app->language = 'pt-PT';
$this->title = $title;
?>

<div class="produto-index">
    <?php
    if($dataProvider != null){ ?>
        <?= Alert::widget() ?>
        <?= $this->render('_search', ['model' => $searchModel]) ?>
        
        <?php if($title == 'Descontos'){?>
            <div class="header-descontos">
                <h5>Promoções até -<?= Desconto::getDescontoMAX()->valor ?>%</h5>
                <h6>Promoções terminam a <?= date('d/m/Y', (strtotime(Desconto::getDescontoMAX()->data_final))) ?></h6>
                <br>
            </div>
        <?php }?>

        <div class="row">
            <?php foreach($db_produtos as $model_produto){
                echo $this->render('_form', ['model_produto' => $model_produto]);
            }?>
        </div>
    <?php }
    else{ ?>
        <div class="produtos-null">
            <h5>Não existem <?= $title ?> disponíveis</h5>
        </div>
    <?php }?>
</div>
