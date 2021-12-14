<?php

use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model_produto common\models\Produto */

if($dataProvider != null){
    $db_produtos = $dataProvider->getModels();
}

Yii::$app->language = 'pt-PT';
$this->title = $title;
?>
<style>
    .produtos-null h5{
        text-transform: uppercase;
        letter-spacing: 1px;
        padding-bottom: 40%;
        margin-top: -5px;
    }
</style>

<div class="produto-index">
    <?php
    if($dataProvider != null){ ?>
        <?= Alert::widget() ?>
        <?= $this->render('_search', ['model' => $searchModel]) ?>

        <div class="row">
            <?php
            foreach($db_produtos as $model_produto){
                echo $this->render('_form', ['model_produto' => $model_produto]);
            }?>
        </div>
    <?php }
    else{ ?>
        <div class="produtos-null offset-4">
            <h5>Não existem <?= $title ?> disponíveis</h5>
        </div>
    <?php }?>
</div>
