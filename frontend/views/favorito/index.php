<?php

use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model_favorito common\models\Favorito */
/* @var $model_produto common\models\Produto */

Yii::$app->language = 'pt-PT';
$this->title = 'Favoritos';
?>

<style>
    .favoritos-null h5{
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding-bottom: 86%;
        margin-top: -5px;
    }
</style>

<div class="favorito-index">
    <?= Alert::widget() ?>
    
    <div class="row">
        <?php
        if($db_favoritos != null){
            foreach($db_favoritos as $model_favorito){
                $model_produto = $model_favorito->produto;
                echo $this->render('..\produto\_form', ['model_produto' => $model_produto]);
            }
        }
        else{ ?>
            <div class="favoritos-null offset-4">
                <h5>A tua lista de favoritos está vazia</h5>
            </div>
        <?php }?>
    </div>
</div>
