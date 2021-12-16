<?php

use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model_favorito common\models\Favorito */
/* @var $model_produto common\models\Produto */

$this->registerCssFile("@web/css/index_favorito.css");

Yii::$app->language = 'pt-PT';
$this->title = 'Favoritos';
?>

<div class="favorito-index">
    <?= Alert::widget() ?>
    
    <?php if($db_favoritos != null){?>
        <div class="row">
            <?php foreach($db_favoritos as $model_favorito){
                $model_produto = $model_favorito->produto;
                echo $this->render('..\produto\_form', ['model_produto' => $model_produto]);
            }?>
        </div>
    <?php }
    else{ ?>
        <div class="favoritos-null">
            <h5>A tua lista de favoritos está vazia</h5>
        </div>
    <?php }?>
</div>
