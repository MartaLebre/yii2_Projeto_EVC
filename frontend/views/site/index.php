<?php

/* @var $this yii\web\View */

use yii\bootstrap4\Html;
use yii\bootstrap4\Carousel;

$this->title = 'eClothingVintage';
?>
<style>
    .carousel-item{
        max-height: 400px;
        object-position: 20% 80%;
    }
    .carousel-indicators{
        top: 0;
        padding-top: 10px;
    }
    .site-footer{
        padding: 45px 0 20px;
        font-size: 14px;
        line-height: 24px;
    }
    .site-footer hr{
        border-top-color: #212529;
        opacity: 0.5;
    }
    .site-footer h6{
        font-size: 16px;
        text-transform: uppercase;
        margin-top: 5px;
        letter-spacing: 2px;
    }
    .footer-links{
        padding-left: 0;
        list-style: none;
    }
    .footer-links li{
        display: block;
    }
    .footer-links a{
        color: #212529;
    }
    .footer-links a:active,.footer-links a:focus,.footer-links a:hover{
        color: #3366cc;
        text-decoration: none;
    }
    .footer-links.inline li{
        display: inline-block;
    }
    .slideshow .btn{
        text-transform: uppercase;
        position: absolute;
        top: 95%;
        left: 45.5%;
    }
    .button-slideshow{
        background-color: #222;
        border-radius: 6px;
        color: #fff;
        display: inline-block;
        font-size: 16px;
        padding: 9px 20px 8px;
        letter-spacing: 2px;
    }
    .button-slideshow:hover, .button-slideshow:focus{
        color: #fff;
        background-color: #151515;
    }
</style>

<div class="site-index">
    <div class="card slideshow">
        <?= yii\bootstrap4\Carousel::widget(['items' => $slideshow]); ?>
        <?= Html::a('Novidades', ['produto/index    '], ['class' => 'btn button-slideshow shadow']) ?>
    </div>
</div>

<footer class="site-footer">
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-9">
                <h6>About</h6>
                <p class="text-justify">Scanfcode.com <i>CODE WANTS TO BE SIMPLE </i> is an initiative  to help the upcoming programmers with the code. Scanfcode focuses on providing the most efficient code or snippets as the code wants to be simple. We will help programmers build up concepts in different programming languages that include C, C++, Java, HTML, CSS, Bootstrap, JavaScript, PHP, Android, SQL and Algorithm.</p>
            </div>

            <div class="col-2 offset-1">
                <h6>Quick Links</h6>
                <ul class="footer-links text-uppercase">
                    <li><a href="#">Novidades</a></li>
                    <li><a href="#">Mystery Boxes</a></li>
                    <li><a href="#">Descontos</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>