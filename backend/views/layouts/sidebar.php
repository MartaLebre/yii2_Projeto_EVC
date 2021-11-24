<?php

use common\models\User;

?>
<style>
    .brand-image {
        margin-top: -10px !important;
        max-height: 45px !important;
    }
</style>

<aside class="main-sidebar sidebar-dark-primary shadow">
    <a href="<?= \yii\helpers\Url::home() ?>" class="brand-link" style="height: 57px">
        <img src="<?= Yii::$app->request->baseUrl ?>/img/logo.png" class="brand-image">
        <span class="brand-text font-weight-light">eClothingVintage</span>
    </a>

    <div class="sidebar">
        <nav style="font-size: 14px">

            <?php  if(User::isAdmin(Yii::$app->user->id)) {
                echo \hail812\adminlte\widgets\Menu::widget([
                    'items' => [
                        ['label' => 'Gestão de Utilizadores', 'header' => true],
                        ['label' => 'Adicionar Gestor de Stock', 'iconClass' => 'nav-icon far fa-circle text-success', 'url' => ['user/create']],
                        ['label' => 'Gerir Utilizadores', 'iconClass' => 'nav-icon far fa-circle text-warning', 'url' => ['user/index']],
                    ],
                ]);
            }
            else {
                echo \hail812\adminlte\widgets\Menu::widget([
                    'items' => [
                        ['label' => 'Gestão de Produtos', 'header' => true],
                        ['label' => 'Adicionar Produtos', 'iconClass' => 'nav-icon far fa-circle text-success', 'url' => ['site/index']],
                        ['label' => 'Gerir Produtos', 'iconClass' => 'nav-icon far fa-circle text-warning', 'url' => ['site/index']],
                    ],
                ]);
            }
            ?>
        </nav>
    </div>
</aside>