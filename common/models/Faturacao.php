<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faturacao".
 *
 * @property int $id_user
 * @property string $primeiro_nome
 * @property string $ultimo_nome
 * @property string $localidade
 * @property int $codigo_postal
 * @property int $nif
 * @property string $morada_faturacao
 *
 * @property User $user
 */
class Faturacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faturacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'primeiro_nome', 'ultimo_nome', 'localidade', 'codigo_postal', 'nif', 'morada_faturacao'], 'required'],
            [['id_user', 'codigo_postal', 'nif'], 'integer'],
            [['primeiro_nome', 'ultimo_nome', 'localidade'], 'string', 'max' => 45],
            [['morada_faturacao'], 'string', 'max' => 90],
            [['nif'], 'unique'],
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
            'primeiro_nome' => 'Primeiro Nome',
            'ultimo_nome' => 'Ultimo Nome',
            'localidade' => 'Localidade',
            'codigo_postal' => 'Codigo Postal',
            'nif' => 'Nif',
            'morada_faturacao' => 'Morada Faturacao',
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

    public function getPerfil()
    {
        return $this->hasOne(Perfil::className(), ['id_user' => 'id_user']);
    }
}
