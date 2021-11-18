<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Faturacao;

/**
 * FaturacaoSearch represents the model behind the search form of `common\models\Faturacao`.
 */
class FaturacaoSearch extends Faturacao
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'codigo_postal', 'nif'], 'integer'],
            [['primeiro_nome', 'ultimo_nome', 'localidade', 'morada_faturacao'], 'safe'],
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
        $query = Faturacao::find();

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
            'id_user' => $this->id_user,
            'codigo_postal' => $this->codigo_postal,
            'nif' => $this->nif,
        ]);

        $query->andFilterWhere(['like', 'primeiro_nome', $this->primeiro_nome])
            ->andFilterWhere(['like', 'ultimo_nome', $this->ultimo_nome])
            ->andFilterWhere(['like', 'localidade', $this->localidade])
            ->andFilterWhere(['like', 'morada_faturacao', $this->morada_faturacao]);

        return $dataProvider;
    }
}
