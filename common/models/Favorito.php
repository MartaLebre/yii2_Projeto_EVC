<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "favorito".
 *
 * @property int $id
 * @property int $codigo_produto
 * @property int $id_user
 *
 * @property Produto $codigoProduto
 * @property User $user
 */
class Favorito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_produto', 'id_user'], 'required'],
            [['id', 'codigo_produto', 'id_user'], 'integer'],
            [['id'], 'unique'],
            [['codigo_produto'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['codigo_produto' => 'codigo_produto']],
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
            'codigo_produto' => 'Codigo Produto',
            'id_user' => 'Id User',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
