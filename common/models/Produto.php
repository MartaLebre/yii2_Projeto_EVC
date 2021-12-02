<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property int $codigo_produto
 * @property string $nome
 * @property string $genero
 * @property string $descricao
 * @property string $tamanho
 * @property float $preco
 * @property int $quantidade
 * @property string $data
 * @property int $id_modelo
 * @property resource|null $foto
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_produto', 'nome', 'genero', 'descricao', 'tamanho', 'preco', 'quantidade', 'data', 'id_modelo'], 'required'],
            [['codigo_produto', 'quantidade', 'id_modelo'], 'integer'],
            [['genero', 'tamanho', 'foto'], 'string'],
            [['preco'], 'number'],
            [['data'], 'safe'],
            [['nome'], 'string', 'max' => 45],
            [['descricao'], 'string', 'max' => 90],
            [['codigo_produto'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo_produto' => 'Codigo Produto',
            'nome' => 'Nome',
            'genero' => 'Genero',
            'descricao' => 'Descrição',
            'tamanho' => 'Tamanho',
            'preco' => 'Preço',
            'quantidade' => 'Quantidade',
            'data' => 'Data',
            'id_modelo' => 'Id Modelo',
            'foto' => 'Foto',
        ];
    }

    public function getModelo()
    {
        return $this->hasOne(Modelo::className(), ['id' => 'id_modelo']);
    }
    
    public function getFavorito()
    {
        return $this->hasOne(Favorito::className(), ['codigo_produto' => 'codigo_produto']);
    }
}
