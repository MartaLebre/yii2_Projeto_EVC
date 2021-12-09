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
    public $searchstring;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['searchstring'], 'safe'],
            [['codigo_produto'], 'integer'],
            [['nome'], 'safe'],
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
        $query = Produto::find()->orderBy(['data' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(['query' => $query]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'codigo_produto' => $this->codigo_produto,
            'nome' => $this->nome,
        ]);

        $query->andFilterWhere([
            'or',
            ['like', 'codigo_produto', $this->searchstring],
            ['like', 'nome', $this->searchstring],
        ]);

        return $dataProvider;
    }
}
