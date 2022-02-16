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
            foreach ($favoritos as $favorito) {
                $produtosFavoritos[] = Produto::find()->where(['codigo_produto' => $favorito->codigo_produto])->one();
            }
            foreach ($produtosFavoritos as $produtosFavorito) {
                $model_modelo = $produtosFavorito->modelo;
                $model_desconto = $model_modelo->desconto;

                if ($model_desconto != null && $model_desconto->getDescontoActivo($model_desconto->id_modelo)) {
                    $preco = $produtosFavorito->preco - ($produtosFavorito->preco * ($model_desconto->valor / 100));
                } else {
                    $preco = $produtosFavorito->preco;
                }

                $produtosFavorito->preco = $preco;

                $produtosFavorito->foto = 'http://192.168.1.189:8080/imagens/' . $produtosFavorito->foto;
            }

            if ($produtosFavoritos != null) {
                return $produtosFavoritos;
            }
            else {
                    return null;
                 }
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

    public function actionCheck($codigo_produto, $token)
    {
        $user = User::find()->where(['verification_token' => $token])->one();
        if ($user != null) {
            $favorito = Favorito::find()->where(['codigo_produto' => $codigo_produto])
                ->andWhere(['id_user' => $user->id])->one();

            if ($favorito != null) {
                return true;
            } else {
                return false;
            }
        } else {
            return "Utilizador não encontrado";
        }

    }
}