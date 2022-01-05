<?php

use common\models\User;
use hail812\adminlte\widgets\Menu;

?>
<style>
    .sidebar-dark-secondary{
        background-color: #222 !important;
    }
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
    .fas{
        font-size: 14px !important;
    }
    .logouthr{
        margin: 0 -8px 3.2px !important;
        border-top: 1px solid #4b545c !important;
    }
</style>

<aside class="main-sidebar sidebar-dark-secondary">
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
    
                        ['label' => 'Logout hr', 'template'=>'<hr class="logouthr">'],
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
    
                        ['label' => 'Logout hr', 'template'=>'<hr class="logouthr">'],
                        ['label' => 'Logout', 'url' => ['site/logout'], 'template'=>'<a href="{url}" data-method="post" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a>'],
                    ],
                ]);
            }
            ?>
        </nav>
    </div>
</aside>