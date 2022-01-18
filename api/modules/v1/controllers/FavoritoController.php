<?php

namespace api\modules\v1\controllers;

use common\models\Favorito;
use common\models\Produto;
use common\models\User;
use yii\rest\ActiveController;


class FavoritoController extends ActiveController
{
    public $modelClass = 'common\models\Favorito';

    public function actionInfo($token){
        $user = User::find()->where(['verification_token' => $token])->one();
        $favoritos = Favorito::find()->where(['id_user' => $user->id])->all();

        if ($favoritos == null) {
            return null;
        } else {
            return $favoritos;
        }
    }

    public function actionAdicionar($token){

        $user = User::find()->where(['verification_token' => $token])->one();

        if ($user != null) {
            $favorito = new Favorito();

            $favorito->codigo_produto = \Yii::$app->request->post('codigo_produto');
            $favorito->id_user = $user->id;

            $favorito->save(false);

            if ($favorito->save() == true) {
                return $favorito;
            } else {
                return null;
            }
        } else {
            return "Utilizador não encontrado";
        }
    }

    public function actionRemover($codigo_produto, $token)
    {
        $user = User::find()->where(['verification_token' => $token])->one();

        if ($user != null) {
            $favorito = Favorito::find()->where(['codigo_produto' => $codigo_produto])
                ->andWhere(['id_user' => $user->id])->one();

            if ($favorito->delete() == true) {
                return true;
            } else {
                return null;
            }
        } else {
            return "Utilizador não encontrado";
        }
    }
}