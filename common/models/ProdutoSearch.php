<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Produto;

/**
 * ProdutoSearch represents the model behind the search form of `common\models\Produto`.
 */
class ProdutoSearch extends Produto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_produto', 'tamanho', 'quantidade', 'id_modelo'], 'integer'],
            [['nome', 'genero', 'descrição', 'data'], 'safe'],
            [['preço'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Produto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'codigo_produto' => $this->codigo_produto,
            'tamanho' => $this->tamanho,
            'preço' => $this->preço,
            'quantidade' => $this->quantidade,
            'data' => $this->data,
            'id_modelo' => $this->id_modelo,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'genero', $this->genero])
            ->andFilterWhere(['like', 'descrição', $this->descrição]);

        return $dataProvider;
    }
}
