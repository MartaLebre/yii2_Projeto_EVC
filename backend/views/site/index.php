<?php
$this->title = 'Backend';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Utilizadores',
                'number' => '1,410',
                'theme' => 'primary',
                'icon' => 'fas fa-user',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Wishlist',
                'number' => '410',
                'theme' => 'danger',
                'icon' => 'fas fa-heart',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Compras',
                'number' => '13,648',
                'theme' => 'success',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>
    </div>
</div>