<?php

use yii\helpers\Html;
?>

<nav class="main-header navbar navbar-expand navbar-white shadow">
    
    <h5 style="margin: 6px"><?= $this->title ?></h5>
    
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
    </ul>
</nav>