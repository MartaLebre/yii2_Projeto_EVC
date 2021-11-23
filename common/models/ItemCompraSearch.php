<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ItemCompra;

/**
 * ItemCompraSearch represents the model behind the search form of `common\models\ItemCompra`.
 */
class ItemCompraSearch extends ItemCompra
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_produto', 'id_encomenda', 'quantidade'], 'integer'],
            [['preço_venda'], 'number'],
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
        $query = ItemCompra::find();

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
            'id_encomenda' => $this->id_encomenda,
            'quantidade' => $this->quantidade,
            'preço_venda' => $this->preço_venda,
        ]);

        return $dataProvider;
    }
}
