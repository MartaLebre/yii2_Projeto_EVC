<?php

/* @var $this yii\web\View */
/* @var $model_produto common\models\Produto */

use common\models\Desconto;
use yii\bootstrap4\Html;
use yii\bootstrap4\Carousel;

$this->registerCssFile("@web/css/site.css");

$this->title = 'eVintageClothing';
?>

<div class="site-index">
    <div class="slideshow">
        <?= yii\bootstrap4\Carousel::widget(['items' => $slideshow]); ?>
        <?= Html::a('Novidades', ['produto/novidades'], ['class' => 'btn btn-block btn-slideshow shadow']) ?>
    </div>

    <div class="produtos-desconto">
        <?php
        if($db_produtos != null){?>
            <div class="header-descontos">
                <hr>
                <h5>Promoções até -<?= Desconto::getDescontoMAX()->valor ?>%</h5>
                <h6>Promoções terminam a <?= date('d/m/Y', (strtotime(Desconto::getDescontoMAX()->data_final))) ?></h6>
                <br>
            </div>
            <div class="row">
                <?php
                foreach($db_produtos as $model_produto){
                    echo $this->render('../produto/_form', ['model_produto' => $model_produto]);
                }?>
            </div>
        <?php }?>
    </div>
</div>