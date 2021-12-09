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
$this->title = 'Descontos';
?>

<div class="produto-index">
    <?= Alert::widget() ?>
    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <div class="row">
        <?php
        if($dataProvider != null){
            foreach($db_produtos as $model_produto){
                echo $this->render('_form', ['model_produto' => $model_produto]);
            }
        }
        else{ ?>
            <p>teste</p>
        <?php }?>
    </div>
</div>