<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property int $codigo_produto
 * @property string $nome
 * @property string $genero
 * @property string $descricao
 * @property string $tamanho
 * @property float $preco
 * @property int $quantidade
 * @property string $data
 * @property int $id_modelo
 * @property string|null $foto
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_produto', 'nome', 'genero', 'descricao', 'tamanho', 'preco', 'quantidade', 'data', 'id_modelo'], 'required'],
            [['codigo_produto', 'quantidade', 'id_modelo'], 'integer'],
            [['genero', 'tamanho'], 'string'],
            [['preco'], 'number'],
            [['data'], 'safe'],
            [['nome'], 'string', 'max' => 45],
            [['descricao'], 'string', 'max' => 90],
            [['foto'], 'string', 'max' => 50],
            [['codigo_produto'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo_produto' => 'Codigo Produto',
            'nome' => 'Nome',
            'genero' => 'Genero',
            'descricao' => 'Descricao',
            'tamanho' => 'Tamanho',
            'preco' => 'Preco',
            'quantidade' => 'Quantidade',
            'data' => 'Data',
            'id_modelo' => 'Id Modelo',
            'foto' => 'Foto',
        ];
    }

    public function getModelo()
    {
        return $this->hasOne(Modelo::className(), ['id' => 'id_modelo']);
    }

    public function getFavorito()
    {
        return $this->hasOne(Favorito::className(), ['codigo_produto' => 'codigo_produto']);
    }

    public function FazPublish($canal, $msg)
    {
        try {
            $server = "127.0.0.1";
            $port = 1883;
            $username = ""; // set your username
            $password = ""; // set your password
            $client_id = "phpMQTT-publisher"; // unique!
            $mqtt = new \api\mosquitto\phpMQTT($server, $port, $client_id);
            if ($mqtt->connect(true, NULL, $username, $password)) {
                $mqtt->publish($canal, $msg, 0);
                $mqtt->close();
            } else {
                file_put_contents("debug.output", "Time out!");
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        //Obter dados do registo em causa
        $codigo_produto = $this->codigo_produto;
        $nome = $this->nome;
        $genero = $this->genero;
        $descricao = $this->descricao;
        $tamanho = $this->tamanho;
        $preco = $this->preco;
        $quantidade = $this->quantidade;
        $data = $this->data;
        $id_modelo = $this->id_modelo;
        $foto = $this->foto;

        $myObj = new \stdClass();
        $myObj->codigo_produto = $codigo_produto;
        $myObj->nome = $nome;
        $myObj->genero = $genero;
        $myObj->descricao = $descricao;
        $myObj->tamanho = $tamanho;
        $myObj->preco = $preco;
        $myObj->quantidade = $quantidade;
        $myObj->data = $data;
        $myObj->id_modelo = $id_modelo;
        $myObj->foto = $foto;

        $myJSON = json_encode($myObj);
        if ($insert)
            $this->FazPublish("INSERT", $myJSON);
        else
            $this->FazPublish("UPDATE", $myJSON);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $codigo_produto = $this->codigo_produto;
        $myObj = new \stdClass();
        $myObj->codigo_produto = $codigo_produto;
        $myJSON = json_encode($myObj);
        $this->FazPublish("DELETE", $myJSON);
    }
}

