<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "modelo".
 *
 * @property int $id
 * @property string $modelo
 *
 * @property Desconto $desconto
 * @property Produto[] $produtos
 */
class Modelo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modelo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'modelo'], 'required'],
            [['id'], 'integer'],
            [['modelo'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'modelo' => 'Modelo',
        ];
    }

    /**
     * Gets query for [[Desconto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDesconto()
    {
        return $this->hasOne(Desconto::className(), ['id_modelo' => 'id']);
    }

    /**
     * Gets query for [[Produtos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['id_modelo' => 'id']);
    }
}
