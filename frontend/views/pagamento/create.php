<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pagamento */

$this->title = 'Pagamento';
$this->params['breadcrumbs'][] = ['label' => 'Pagamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagamento-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
