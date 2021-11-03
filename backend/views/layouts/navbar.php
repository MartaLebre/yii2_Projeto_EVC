<?php

use yii\helpers\Html;

?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
    </ul>
</nav>
<!-- /.navbar -->