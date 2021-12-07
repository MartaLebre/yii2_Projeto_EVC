<?php

use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model_favorito common\models\Favorito */
/* @var $model_produto common\models\Produto */

$this->title = 'Favoritos';
Yii::$app->language = 'pt-PT';
?>

<div class="favorito-index">
    <?= Alert::widget() ?>
    
    <div class="row">
        <?php
        foreach($db_favoritos as $model_favorito){
            $model_produto = $model_favorito->produto;
            echo $this->render('..\produto\_form', ['model_produto' => $model_produto]);
        }?>
    </div>
</div>
