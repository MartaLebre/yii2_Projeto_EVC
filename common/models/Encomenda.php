<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "encomenda".
 *
 * @property int $id
 * @property string $estado
 * @property string $data
 * @property int $id_user
 *
 * @property Produto[] $codigoProdutos
 * @property ItemCompra[] $itemCompras
 * @property User $user
 */
class Encomenda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'encomenda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'estado', 'data', 'id_user'], 'required'],
            [['id', 'id_user'], 'integer'],
            [['estado'], 'string'],
            [['data'], 'safe'],
            [['id'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estado' => 'Estado',
            'data' => 'Data',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[CodigoProdutos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoProdutos()
    {
        return $this->hasMany(Produto::className(), ['codigo_produto' => 'codigo_produto'])->viaTable('item_compra', ['id_encomenda' => 'id']);
    }

    /**
     * Gets query for [[ItemCompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemCompras()
    {
        return $this->hasMany(ItemCompra::className(), ['id_encomenda' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}