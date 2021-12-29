<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Perfil;

/**
 * Signup form
 */
class UserForm extends Model
{
    public $username;
    public $email;
    public $password;
    
    //perfil
    public $telemovel;
    public $primeiro_nome;
    public $ultimo_nome;
    
    
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Necessário introduzir um username.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este username já está registado.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Necessário introduzir um email.'],
            ['email', 'email', 'message' => 'Email incorreto.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este email já está registado.'],
            
            ['password', 'required', 'message' => 'Necessário introduzir uma password.'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            
            ['telemovel', 'integer', 'message' => 'Número de telemóvel incorreto.'],
            ['telemovel', 'required', 'message' => 'Necessário introduzir um número de telemóvel.'],
            ['telemovel', 'unique', 'targetClass' => '\common\models\Perfil', 'message' => 'Este número de telemóvel já está registado.'],
            [
                'telemovel', 'string', 'min' => 9, 'max' => 9,
                'tooShort' => 'O número de telemóvel tem que ter 9 dígitos.',
                'tooLong' => 'O número de telemóvel tem que ter 9 dígitos.'
            ],
            
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
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'primeiro_nome' => 'Primeiro Nome',
            'ultimo_nome' => 'Último Nome',
            'telemovel' => 'Telemóvel',
            'morada' => 'Morada',
        ];
    }
    
    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function createUser()
    {
        if (!$this->validate()) {
            return null;
        }
        
        //user
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();
        
        //perfil
        $perfil = new Perfil();
        $perfil->primeiro_nome = $this->primeiro_nome;
        $perfil->ultimo_nome = $this->ultimo_nome;
        $perfil->telemovel = $this->telemovel;
        $perfil->id_user = $user->id;
        $perfil->save();
        
        $auth = \Yii::$app->authManager;
        $clienteRole = $auth->getRole('gestorStock');
        $auth->assign($clienteRole, $user->getId());
        
        return true;
    }
    
    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}