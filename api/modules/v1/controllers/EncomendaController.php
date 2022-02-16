<?php

namespace api\modules\v1\controllers;

use common\models\Encomenda;
use common\models\Favorito;
use common\models\Produto;
use common\models\User;
use yii\rest\ActiveController;


class EncomendaController extends ActiveController
{
    public $modelClass = 'common\models\Encomenda';

    public function actionAll($token){

        $user = User::find()->where(['verification_token' => $token])->one();
        $encomendas = Encomenda::find()->where(['id_user' => $user->id])->andWhere(['<>', 'estado', 'carrinho'])->all();

        if ($encomendas == null) {
            return null;
        } else {
            return $encomendas;
        }
    }
}