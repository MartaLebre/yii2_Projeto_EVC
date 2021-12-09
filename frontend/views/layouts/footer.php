<?php

use yii\helpers\Html;

$this->registerCssFile("@web/css/footer.css");
?>

<div class="site-footer container">
    <hr>
    <div class="row">
        <div class="col-9">
            <h6>About</h6>
            <p class="text-justify">A eVintageClothing é uma loja online em desenvolvimento criada por estudantes da ESTG, do curso de Programação de Sistemas de informação.
                Esta loja foi criada com o objetivo de realização de um projeto de final de curso e com o objetivo de conhecer e dar a conhecer mais sobre o mundo de roupa Vintage.
                <br>Seja bem vindo ao site e desfrute de todos os produtos, incluindo Mystery Boxes!</p>
        </div>

        <div class="col-2 offset-1">
            <h6>Quick Links</h6>
            <ul class="footer-links text-uppercase">
                <li><?= Html::a('Novidades', ['produto/novidades'], ['class' => 'footer-links']) ?></li>
                <li><?= Html::a('Mystery Boxes', ['produto/mysteryboxes'], ['class' => 'footer-links']) ?></li>
                <li><?= Html::a('Descontos', ['produto/descontos'], ['class' => 'footer-links']) ?></li>
            </ul>
        </div>
    </div>
</div>