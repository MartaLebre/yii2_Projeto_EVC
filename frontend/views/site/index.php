<?php

/* @var $this yii\web\View */
/* @var $model_produto common\models\Produto */

use yii\bootstrap4\Html;
use yii\bootstrap4\Carousel;

$this->registerCssFile("@web/css/site.css");
$this->registerCssFile("@web/css/card.css");

$this->title = 'eVintageClothing';
?>

<div class="site-index">
    <div class="card slideshow">
        <?= yii\bootstrap4\Carousel::widget(['items' => $slideshow]); ?>
        <?= Html::a('Novidades', ['produto/index'], ['class' => 'btn button-slideshow shadow']) ?>
    </div>
    
    <?php
    if($db_produtos != null){?>
        <hr>
        <div class="row produtos-desconto">
            <?php
            foreach($db_produtos as $model_produto){
                echo $this->render('../produto/_form', ['model_produto' => $model_produto]);
            }?>
        </div>
    <?php }?>
</div>