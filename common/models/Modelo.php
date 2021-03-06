<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "modelo".
 *
 * @property int $id
 * @property string $nome
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
            ['nome', 'required', 'message' => 'Necessário introduzir um nome.'],
            ['nome', 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
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

    public static function getModelos(){

        $modelos = Modelo::find()
            ->where(['<>', 'nome', 'Mystery Boxes'])
            ->all();

        return $modelos;
    }
}
