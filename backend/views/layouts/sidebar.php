<?php

use common\models\User;
use hail812\adminlte\widgets\Menu;

?>
<style>
    .brand-image {
        margin-top: -10px !important;
        max-height: 45px !important;
    }
    .brand-link{
        height: 57px;
    }
    .sidebar nav{
        font-size: 14px;
    }
</style>

<aside class="main-sidebar sidebar-dark-secondary" style="background-color: #222">
    <a href="<?= \yii\helpers\Url::home() ?>" class="brand-link">
        <img src="<?= Yii::$app->request->baseUrl ?>/img/logo.png" class="brand-image">
        <span class="brand-text font-weight-light">eVintageClothing</span>
    </a>

    <div class="sidebar text-uppercase">
        <nav>
            <?php
            if(User::isAdmin(Yii::$app->user->id)) {
                echo Menu::widget([
                    'items' => [
                        ['label' => 'Gestão de Utilizadores', 'header' => true],
                        ['label' => 'Adicionar Gestor de Stock', 'iconClass' => 'nav-icon far fa-circle text-success', 'url' => ['user/create']],
                        ['label' => 'Gerir Utilizadores', 'iconClass' => 'nav-icon far fa-circle text-warning', 'url' => ['user/index']],
                    ],
                ]);
            }
            else {
                echo Menu::widget([
                    'items' => [
                        ['label' => 'Gestão de Produtos', 'header' => true],
                        ['label' => 'Modelos', 'iconClass' => 'nav-icon fas fa-plus', 'url' => ['modelo/index']],
                        ['label' => 'Produtos', 'iconClass' => 'nav-icon fas fa-plus', 'url' => ['produto/index']],
                        ['label' => 'Gestão de Encomendas', 'header' => true],
                        ['label' => 'Encomendas', 'iconClass' => 'nav-icon far fa-circle', 'url' => ['encomenda/index']],
                        ['label' => 'Logout', 'iconClass' => 'nav-icon far fa-circle', 'url' => ['site/logout'], 'template'=>'<a href="{url}" data-method="post">{label}</a>'],
                    ],
                ]);
            }
            ?>
        </nav>
    </div>
</aside>