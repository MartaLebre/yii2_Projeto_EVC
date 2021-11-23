<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "desconto".
 *
 * @property int $id_modelo
 * @property string $data_começo
 * @property string $data_final
 * @property int $desconto
 *
 * @property Modelo $modelo
 */
class Desconto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'desconto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_modelo', 'data_começo', 'data_final', 'desconto'], 'required'],
            [['id_modelo', 'desconto'], 'integer'],
            [['data_começo', 'data_final'], 'safe'],
            [['id_modelo'], 'unique'],
            [['id_modelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['id_modelo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_modelo' => 'Id Modelo',
            'data_começo' => 'Data Começo',
            'data_final' => 'Data Final',
            'desconto' => 'Desconto',
        ];
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
