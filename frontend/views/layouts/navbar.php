<?php

use yii\helpers\Html;

?>
<style>
    .brand-link{
        letter-spacing: 1px;
        font-size: 22px;
    }
    .brand-link:link, .brand-link:visited{
        color: #222 !important;
    }
    .brand-link:hover{
        color: black !important;
    }
    .navbar-search{
        padding-right: 25%;
        padding-left: 5%;
    }
    .navbar-search form, .navbar-search .input-group{
        width: 150%;
    }
    .navbar-icons{
        padding-left: 30%;
    }
    .brand-image{
        margin-top: -12px !important;
        max-height: 50px !important;
    }
    .navbar-dark{
        letter-spacing: 1px;
        background-color: #222;
        height: 46px;
        padding-left: 31%;
    }
</style>

<nav class="navbar navbar-expand navbar-light navbar-white">
    <!-- SEARCH FORM -->
    <div class="navbar-search">
        <form class="form-inline">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div>
        <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
            <img src="<?=Yii::getAlias('@web'); ?>/img/logo.png" class="brand-image">
            <span class="brand-text font-weight-light">eClothingVintage</span>
        </a>
    </div>


    <!-- Right navbar links -->
    <div class="navbar-icons">
        <ul class="navbar-nav">
            <li class="nav-item">
                <?= Html::a('<i class="fas fa-shopping-bag"></i>', ['#'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
                <?= Html::a('<i class="fas fa-heart text-danger"></i>', ['#'], ['class' => 'nav-link']) ?>
            </li>
            <?php if(Yii::$app->user->isGuest){ ?>
                <li class="nav-item">
                    <?= Html::a('<i class="fas fa-user text-primary"></i>', ['site/login'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                </li>
            <?php }
            else{ ?>
                <li class="nav-item">
                    <?= Html::a('<i class="fas fa-user-edit text-primary"></i>', ['perfil/update', 'id' => Yii::$app->user->id], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                </li>
            <?php }?>
        </ul>
    </div>
</nav>

<nav class="navbar navbar-expand navbar-dark shadow">
    <ul class="navbar-nav text-uppercase">
        <li class="nav-item">
            <a href="<?=\yii\helpers\Url::home()?>" class="nav-link">Home</a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">Novos Produtos</a>
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