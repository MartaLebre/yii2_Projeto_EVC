<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCssFile("@web/css/navbar.css");
$db_modelos = \common\models\Modelo::find()->all();
?>

<nav class="navbar navbar-expand navbar-light">
    <?= Html::a('<img src="' . Yii::getAlias('@web') . '/img/logo.png" class="brand-image">
                     <h6 class="brand-text font-weight-light">eVintageClothing</h6>', Url::home(), ['class' => 'brand-link']) ?>
    
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
                    <?= Html::a('<i class="fas fa-shopping-cart"></i>', ['itemcompra/index'], ['id' => 'carrinhoindex']) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="fas fa-dolly"></i>', ['encomenda/index'], ['id' => 'encomendaindex']) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="fas fa-heart"></i>', ['favorito/index'], ['id' => 'favindex']) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="fas fa-user"></i>', ['perfil/update', 'id' => Yii::$app->user->id], ['id' => 'editar']) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['site/logout'], ['data-method' => 'post']) ?>
                </li>
            </ul>
        </div>
    <?php }?>
</nav>

<nav class="navbar navbar-expand navbar-dark shadow">
    <ul class="navbar-nav nav-dark">
        <li class="nav-item">
            <?= Html::a('Novidades', ['produto/novidades'], ['class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= Html::a('Homem', ['#'], ['class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= Html::a('Mulher', ['#'], ['class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= Html::a('Mystery Boxes', ['produto/mysteryboxes'], ['class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= Html::a('Promoções', ['produto/descontos'], ['class' => 'nav-link']) ?>
        </li>
    </ul>
</nav>