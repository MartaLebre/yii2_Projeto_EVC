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
            ['id_modelo', 'required'],
            ['id_modelo', 'unique'],
            ['id_modelo', 'integer'],
            [['id_modelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['id_modelo' => 'id']],
    
            ['data_comeco', 'required', 'message' => 'Necessário introduzir uma data.'],
            ['data_comeco', 'safe', 'message' => 'Data incorreta.'],
            
            ['data_final', 'required', 'message' => 'Necessário introduzir uma data.'],
            ['data_final', 'safe', 'message' => 'Data incorreta.'],
    
            ['valor', 'required', 'message' => 'Necessário introduzir um valor.'],
            ['valor', 'integer', 'message' => 'Valor incorreto.'],
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
    
    public static function getDescontoMAX()
    {
        $model_desconto = new Desconto();
        
        $model_desconto->valor = Desconto::find()
            ->where(['<=', 'data_comeco', date('Y-m-d')])
            ->andWhere(['>=', 'data_final', date('Y-m-d')])
            ->max('valor');
    
        $model_desconto->data_final = Desconto::find()
            ->where(['<=', 'data_comeco', date('Y-m-d')])
            ->andWhere(['>=', 'data_final', date('Y-m-d')])
            ->max('data_final');
        
        return $model_desconto;
    }
}
