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
            [['id_user','data_validade'], 'required'],

            ['numero_cartao', 'integer', 'message' => 'Número do Cartão incorreto.'],
            ['numero_cartao', 'required', 'message' => 'Necessário introduzir o número do Cartão.'],
            ['numero_cartao', 'unique', 'targetClass' => '\common\models\Pagamento', 'message' => 'Este número do cartão já está registado.'],
            [
                'numero_cartao', 'string', 'min' => 16, 'max' => 16,
                'tooShort' => 'O número do cartão tem que ter 16 dígitos.',
                'tooLong' => 'O número do cartão tem que ter 16 dígitos.'
            ],
            ['codigo_seguranca', 'integer', 'message' => 'O código de segurança está  incorreto.'],
            ['codigo_seguranca', 'required', 'message' => 'Necessário introduzir o código de segurança.'],
            ['codigo_seguranca', 'unique', 'targetClass' => '\common\models\Pagamento', 'message' => 'Este código de segurança já está registado.'],
            [
                'codigo_seguranca', 'string', 'min' => 3, 'max' => 3,
                'tooShort' => 'O código de segurança tem que ter 3 dígitos.',
                'tooLong' => 'O código de segurança tem que ter 3 dígitos.'
            ],
            [['id_user'], 'integer'],
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
