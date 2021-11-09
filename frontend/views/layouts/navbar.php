<?php

use yii\helpers\Html;

?>
<style>
    #brandlink:link, #brandlink:visited{
        color:rgba(0,0,0,.8); !important;
    }
    #brandlink:hover{
        color: black !important;
    }
    
    .brand-image{
        margin-top: -12px !important;
        max-height: 50px !important;
    }
</style>
<!-- Navbar -->
<nav class="navbar navbar-expand navbar-light navbar-white" style="height: 76px">

    <!-- SEARCH FORM -->
    <div style="padding-right: 25%; padding-left: 5%">
        <form class="form-inline" style="width: 150%">
            <div class="input-group input-group-sm" style="width: 150%">
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
        <a id="brandlink" href="<?=\yii\helpers\Url::home()?>" class="brand-link">
            <img src="<?=Yii::getAlias('@web'); ?>/img/logo.png" class="brand-image" style="size: ">
            <span class="brand-text font-weight-light">eClothingVintage</span>
        </a>
    </div>


    <!-- Right navbar links -->
    <div style="padding-left: 30%">
        <ul class="navbar-nav">
            <li class="nav-item">
                <?= Html::a('<i class="fas fa-shopping-bag"></i>', ['#'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
                <?= Html::a('<i class="fas fa-heart text-danger"></i>', ['#'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
                <?= Html::a('<i class="fas fa-user text-primary"></i>', ['/site/login'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
                <?php if(!Yii::$app->user->isGuest){
                   echo Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']);
                }?>
            </li>
        </ul>
    </div>
</nav>
<!-- /.navbar -->
<nav class="navbar navbar-expand navbar-dark shadow" style="height: 46px">
    <ul class="navbar-nav" style="padding-left: 32%">
        <li class="nav-item">
            <a href="#" class="nav-link">Home</a>
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
<!-- /.navbar -->