<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "perfil".
 *
 * @property string $primeiro_nome
 * @property string $ultimo_nome
 * @property int $telemovel
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
            [['primeiro_nome', 'ultimo_nome', 'telemovel', 'id_user'], 'required'],
            [['telemovel', 'id_user'], 'integer'],
            [['primeiro_nome', 'ultimo_nome'], 'string', 'max' => 45],
            [['telemovel'], 'unique'],
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
            'primeiro_nome' => 'Primeiro Nome',
            'ultimo_nome' => 'Ultimo Nome',
            'telemovel' => 'Telemovel',
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
