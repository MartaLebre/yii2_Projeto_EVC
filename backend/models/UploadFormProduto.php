<?php


namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadFormProduto extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            ['imageFile', 'required', 'message' => 'Necessário introduzir uma imagem.'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs(Yii::getAlias('@api').'/web/imagens/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
