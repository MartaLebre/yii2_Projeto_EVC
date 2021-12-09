<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "perfil".
 *
 * @property int $id
 * @property string $primeiro_nome
 * @property string $ultimo_nome
 * @property int $telemovel
 * @property string|null $morada
 * @property int $id_user
 *
 * @property User $user
 */
class Perfil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['id_user', 'required'],
            ['id_user', 'integer'],
            
            [['morada'], 'string', 'max' => 90],
    
            ['primeiro_nome', 'required', 'message' => 'Necessário introduzir um primeiro nome.'],
            [
                'primeiro_nome', 'string', 'min' => 2, 'max' => 45,
                'tooShort' => 'O nome tem que ter no mínimo 2 digitos.',
                'tooLong' => 'O nome não pode exceder os 45 digitos.'
            ],
    
            ['ultimo_nome', 'required', 'message' => 'Necessário introduzir um apelido.'],
            [
                'ultimo_nome', 'string', 'min' => 2, 'max' => 45,
                'tooShort' => 'O apelido tem que ter no mínimo 2 digitos.',
                'tooLong' => 'O apelido não pode exceder os 45 digitos.'
            ],
            
            ['telemovel', 'integer', 'message' => 'Número de telemóvel incorreto.'],
            ['telemovel', 'required', 'message' => 'Necessário introduzir um número de telemóvel.'],
            ['telemovel', 'unique', 'targetClass' => '\common\models\Perfil', 'message' => 'Este número de telemóvel já está registado.'],
            [
                'telemovel', 'string', 'min' => 9, 'max' => 9,
                'tooShort' => 'O número de telemóvel tem que ter 9 dígitos.',
                'tooLong' => 'O número de telemóvel tem que ter 9 dígitos.'
            ],
            
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
            'primeiro_nome' => 'Primeiro Nome',
            'ultimo_nome' => 'Ultimo Nome',
            'telemovel' => 'Telemovel',
            'morada' => 'Morada',
            'id_user' => 'Id User',
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
