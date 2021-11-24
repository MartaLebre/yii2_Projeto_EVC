<?php

use yii\helpers\Html;

?>
<style>
    .navbar-light{
        background-color: white;
        margin: 5px;
    }
    .brand-link{
        font-size: 22px;
    }
    .brand-link:link, .brand-link:visited{
        color: #222 !important;
    }
    .brand-link:hover{
        color: black !important;
    }
    .navbar-icons-login{
        padding-top: 4%;
        padding-left: 60%;
    }
    .navbar-icons-guest{
        text-transform: uppercase;
        padding-top: 4%;
        padding-left: 80%;
    }
    .brand-image{
        margin-top: -12px !important;
        max-height: 50px !important;
    }
    .navbar-dark{
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 1px;
        background-color: #222;
        height: 40px;
        padding-left: 32%;
        margin-bottom: 15px;
    }
</style>

<nav class="navbar-expand navbar-light">
    <div class="row">
        <div class="col-2 offset-5">
            <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
                <img src="<?=Yii::getAlias('@web'); ?>/img/logo.png" class="brand-image">
                <span class="brand-text font-weight-light">eClothingVintage</span>
            </a>
        </div>
        <div class="col-2 offset-2">
            <?php if(Yii::$app->user->isGuest){ ?>
                <div class="navbar-icons-guest">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?= Html::a('Login', ['site/login'], ['class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('Signup', ['site/signup'], ['class' => 'nav-link']) ?>
                        </li>
                    </ul>
                </div>
            <?php }
            else{ ?>
                <div class="navbar-icons-login">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?= Html::a('<i class="fas fa-shopping-bag"></i>', ['#'], ['class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('<i class="fas fa-heart text-danger"></i>', ['#'], ['class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('<i class="fas fa-user-edit text-primary"></i>', ['perfil/update', 'id' => Yii::$app->user->id], ['class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                        </li>
                    </ul>
                </div>
            <?php }?>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand navbar-dark shadow">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="<?=\yii\helpers\Url::home()?>" class="nav-link">Home</a>
        </li>

        <li class="nav-item">
            <?= Html::a('Novidades', ['produto/index'], ['class' => 'nav-link']) ?>
        </li>

        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Produtos</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><?= Html::a('Modelos..', ['#'], ['class' => 'dropdown-item']) ?></li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">Mystery Boxes</a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">Descontos</a>
        </li>
    </ul>
</nav>