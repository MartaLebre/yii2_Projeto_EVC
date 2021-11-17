<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property int $codigo_produto
 * @property string $nome
 * @property string $genero
 * @property string $descrição
 * @property int $tamanho
 * @property float $preço
 * @property int $quantidade
 * @property string $data
 * @property int $id_modelo
 *
 * @property Encomenda[] $encomendas
 * @property Favorito[] $favoritos
 * @property Foto[] $fotos
 * @property ItemCompra[] $itemCompras
 * @property Modelo $modelo
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
            [['codigo_produto', 'nome', 'genero', 'descrição', 'tamanho', 'preço', 'quantidade', 'data', 'id_modelo'], 'required'],
            [['codigo_produto', 'tamanho', 'quantidade', 'id_modelo'], 'integer'],
            [['genero'], 'string'],
            [['preço'], 'number'],
            [['data'], 'safe'],
            [['nome'], 'string', 'max' => 45],
            [['descrição'], 'string', 'max' => 90],
            [['codigo_produto'], 'unique'],
            [['id_modelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['id_modelo' => 'id']],
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
            'descrição' => 'Descrição',
            'tamanho' => 'Tamanho',
            'preço' => 'Preço',
            'quantidade' => 'Quantidade',
            'data' => 'Data',
            'id_modelo' => 'Id Modelo',
        ];
    }

    /**
     * Gets query for [[Encomendas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncomendas()
    {
        return $this->hasMany(Encomenda::className(), ['id' => 'id_encomenda'])->viaTable('item_compra', ['codigo_produto' => 'codigo_produto']);
    }

    /**
     * Gets query for [[Favoritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::className(), ['codigo_produto' => 'codigo_produto']);
    }

    /**
     * Gets query for [[Fotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFotos()
    {
        return $this->hasMany(Foto::className(), ['codigo_produto' => 'codigo_produto']);
    }

    /**
     * Gets query for [[ItemCompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemCompras()
    {
        return $this->hasMany(ItemCompra::className(), ['codigo_produto' => 'codigo_produto']);
    }

    /**
     * Gets query for [[Modelo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModelo()
    {
        return $this->hasOne(Modelo::className(), ['id' => 'id_modelo']);
    }
}
