<?php

namespace api\modules\v1\controllers;

use common\models\Produto;
use yii\rest\ActiveController;

class ProdutoController extends ActiveController
{
    public $modelClass = 'common\models\Produto';

    public function actionPesquisa($pesquisa){
        $pesquisaCodigo = Produto::find()
            ->andFilterWhere(['like', 'codigo_produto', $pesquisa])
            ->one();

        if ($pesquisaCodigo != null){
            $produtos = $pesquisaCodigo;
        }

        if($produtos != null){
            foreach ($produtos as $produto){
                if($produto->codigo_produto != null){
                    $produto->codigo_produto = Produto::find()->where(['codigo_produto' => $produto->codigo_produto])->one()->nome;
                    $produto->codigo_produto = Produto::find()->where(['codigo_produto' => $produto->codigo_produto])->one()->descrição;
                    $produto->codigo_produto = Produto::find()->where(['codigo_produto' => $produto->codigo_produto])->one()->preço;
                }
                $produto->foto = 'http://10.0.2.2:9515/imagens/img-pt/' . $produto->foto;
            }
            return $produtos;
        }
    }
}