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
    .far, .fas{
        font-size: 14px !important;
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
                        ['label' => 'Adicionar Gestor', 'iconClass' => 'nav-icon fas fa-user-plus', 'url' => ['user/create']],
                        ['label' => 'Gerir Utilizadores', 'iconClass' => 'nav-icon fas fa-users', 'url' => ['user/index']],
                        
                        ['label' => 'Logout', 'url' => ['site/logout'], 'template'=>'<a href="{url}" data-method="post" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a>'],
                    ],
                ]);
            }
            else {
                echo Menu::widget([
                    'items' => [
                        ['label' => 'Gestão de Produtos', 'header' => true],
                        ['label' => 'Modelos', 'iconClass' => 'nav-icon fas fa-tshirt', 'url' => ['modelo/index']],
                        ['label' => 'Produtos', 'iconClass' => 'nav-icon fas fa-tshirt', 'url' => ['produto/index']],
                        
                        ['label' => 'Gestão de Encomendas', 'header' => true],
                        ['label' => 'Encomendas', 'iconClass' => 'nav-icon fas fa-dolly', 'url' => ['encomenda/index']],
                        
                        ['label' => 'Logout', 'url' => ['site/logout'], 'template'=>'<a href="{url}" data-method="post" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a>'],
                    ],
                ]);
            }
            ?>
        </nav>
    </div>
</aside>