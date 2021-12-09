<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "desconto".
 *
 * @property int $id_modelo
 * @property string $data_comeco
 * @property string $data_final
 * @property int $valor
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
            [['id_modelo', 'data_comeco', 'data_final', 'valor'], 'required'],
            [['id_modelo', 'valor'], 'integer'],
            [['data_comeco', 'data_final'], 'safe'],
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
            'data_comeco' => 'Data Começo',
            'data_final' => 'Data Final',
            'valor' => 'Valor',
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
    
    public function getDescontoActivo($id_modelo)
    {
        $db_descontos = Desconto::find()
            ->where(['id_modelo' => $id_modelo])
            ->andWhere(['<=', 'data_comeco', date('Y-m-d')])
            ->andWhere(['>=', 'data_final', date('Y-m-d')])
            ->one();
        
        if($db_descontos != null){
            return true;
        }
        
        return false;
    }
}
