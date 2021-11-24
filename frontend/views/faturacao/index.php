<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FaturacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faturacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faturacao-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Faturacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_user',
            'primeiro_nome',
            'ultimo_nome',
            'localidade',
            'codigo_postal',
            //'nif',
            //'morada_faturacao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>