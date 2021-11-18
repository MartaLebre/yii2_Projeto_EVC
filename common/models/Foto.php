<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "foto".
 *
 * @property int $id
 * @property string|null $codigo_foto
 * @property int $codigo_produto
 *
 * @property Produto $codigoProduto
 */
class Foto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'foto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'codigo_produto'], 'required'],
            [['id', 'codigo_produto'], 'integer'],
            [['codigo_foto'], 'string', 'max' => 45],
            [['id'], 'unique'],
            [['codigo_produto'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['codigo_produto' => 'codigo_produto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo_foto' => 'Codigo Foto',
            'codigo_produto' => 'Codigo Produto',
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
}
