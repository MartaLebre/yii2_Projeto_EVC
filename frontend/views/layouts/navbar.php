<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCssFile("@web/css/navbar.css");
?>

<nav class="navbar-expand navbar-light">
    <div class="row">
        <div class="col-2 offset-5">
            <a href="<?= Url::home()?>" class="brand-link">
                <img src="<?=Yii::getAlias('@web'); ?>/img/logo.png" class="brand-image">
                <span class="brand-text font-weight-light">eVintageClothing</span>
            </a>
        </div>
        <div class="col-2 offset-3">
            <?php if(Yii::$app->user->isGuest){ ?>
                <div class="navbar-icons-guest">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?= Html::a('<i class="fas fa-sign-in-alt"></i>', ['site/login']) ?>
                        </li>
                    </ul>
                </div>
            <?php }
            else{ ?>
                <div class="navbar-icons-login">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?= Html::a('<i class="fas fa-shopping-bag"></i>', ['itemcompra/index']) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('<i class="fas fa-heart"></i>', ['favorito/index']) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('<i class="fas fa-user-edit"></i>', ['perfil/update', 'id' => Yii::$app->user->id]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['site/logout'], ['data-method' => 'post']) ?>
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
            <a href="<?= Url::home()?>" class="nav-link">Home</a>
        </li>

        <li class="nav-item">
            <?= Html::a('Novidades', ['produto/index'], ['class' => 'nav-link']) ?>
        </li>
        
        <?php $modelos = \common\models\Modelo::find()->all(); ?>
        
        <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">Homem</a>
            <ul aria-labelledby="dropdownSubMenu" class="dropdown-menu border-0 shadow">
                <?php foreach($modelos as $modelo){ ?>
                    <li><?= Html::a($modelo->nome, ['#'], ['class' => 'dropdown-item']) ?></li>
                <?php }?>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">Mulher</a>
            <ul aria-labelledby="dropdownSubMenu" class="dropdown-menu border-0 shadow">
                <li><?= Html::a('Modelos..', ['#'], ['class' => 'dropdown-item']) ?></li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">Mystery Boxes</a>
        </li>

        <li class="nav-item">
            <?= Html::a('Descontos', ['produto/descontos'], ['class' => 'nav-link']) ?>
        </li>
    </ul>
</nav>