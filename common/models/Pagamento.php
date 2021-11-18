<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pagamento".
 *
 * @property int $id_user
 * @property int $numero_cartao
 * @property string $data_validade
 * @property int $codigo_segurança
 *
 * @property User $user
 */
class Pagamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pagamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'numero_cartao', 'data_validade', 'codigo_segurança'], 'required'],
            [['id_user', 'numero_cartao', 'codigo_segurança'], 'integer'],
            [['data_validade'], 'safe'],
            [['id_user'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'numero_cartao' => 'Numero Cartao',
            'data_validade' => 'Data Validade',
            'codigo_segurança' => 'Codigo Segurança',
        ];
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
