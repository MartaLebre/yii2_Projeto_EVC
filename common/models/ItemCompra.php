<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_compra".
 *
 * @property int $codigo_produto
 * @property int $id_encomenda
 * @property int $quantidade
 * @property float $preço_venda
 *
 * @property Produto $codigoProduto
 * @property Encomenda $encomenda
 */
class ItemCompra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_compra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_produto', 'id_encomenda', 'quantidade', 'preço_venda'], 'required'],
            [['codigo_produto', 'id_encomenda', 'quantidade'], 'integer'],
            [['preço_venda'], 'number'],
            [['codigo_produto', 'id_encomenda'], 'unique', 'targetAttribute' => ['codigo_produto', 'id_encomenda']],
            [['id_encomenda'], 'exist', 'skipOnError' => true, 'targetClass' => Encomenda::className(), 'targetAttribute' => ['id_encomenda' => 'id']],
            [['codigo_produto'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['codigo_produto' => 'codigo_produto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo_produto' => 'Codigo Produto',
            'id_encomenda' => 'Id Encomenda',
            'quantidade' => 'Quantidade',
            'preço_venda' => 'Preço Venda',
        ];
    }

    /**
     * Gets query for [[CodigoProduto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoProduto()
    {
        return $this->hasOne(Produto::className(), ['codigo_produto' => 'codigo_produto']);
    }

    /**
     * Gets query for [[Encomenda]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncomenda()
    {
        return $this->hasOne(Encomenda::className(), ['id' => 'id_encomenda']);
    }
}
