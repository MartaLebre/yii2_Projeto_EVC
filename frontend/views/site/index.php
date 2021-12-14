<?php

/* @var $this yii\web\View */
/* @var $model_produto common\models\Produto */

use yii\bootstrap4\Html;
use yii\bootstrap4\Carousel;

$this->registerCssFile("@web/css/site.css");

$this->title = 'eVintageClothing';
?>

<div class="site-index">
    <div class="slideshow">
        <?= yii\bootstrap4\Carousel::widget(['items' => $slideshow]); ?>
        <?= Html::a('Novidades', ['produto/novidades'], ['class' => 'btn button-slideshow shadow']) ?>
    </div>

    <div class="produtos-desconto">
        <?php
        if($db_produtos != null){?>
            <hr class="hr-descontos">
            <div class="row">
                <?php
                foreach($db_produtos as $model_produto){
                    echo $this->render('../produto/_form', ['model_produto' => $model_produto]);
                }?>
            </div>
        <?php }?>
    </div>
</div>