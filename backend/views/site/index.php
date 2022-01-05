

<?php

use common\widgets\Alert;

$this->title = 'Backend';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<?= Alert::widget() ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Utilizadores',
                'number' => \backend\controllers\SiteController::actionTotalUsers(),
                'theme' => 'primary',
                'icon' => 'fas fa-user',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Favoritos',
                'number' => \backend\controllers\SiteController::actionTotalFavoritos(),
                'theme' => 'success',
                'icon' => 'fas fa-heart',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Encomendas',
                'number' => \backend\controllers\SiteController::actionTotalEncomendas(),
                'theme' => 'danger',
                'icon' => 'fas fa-dolly',
            ]) ?>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Produtos',
                'number' => \backend\controllers\SiteController::actionTotalProdutos(),
                'theme' => 'danger',
                'icon' => 'fas fa-tshirt',
            ]) ?>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Descontos',
                'number' => \backend\controllers\SiteController::actionTotalDescontos(),
                'theme' => 'secondary',
                'icon' => 'fas fa-percent',
            ]) ?>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Mystery Boxes',
                'number' => \backend\controllers\SiteController::actionTotalMysteryBoxes(),
                'theme' => 'primary',
                'icon' => 'fas fa-box',
            ]) ?>
        </div>
    </div>
</div>