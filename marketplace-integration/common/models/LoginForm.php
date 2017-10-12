<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username'], 'required'],
            // rememberMe must be a boolean value
           // ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
           // ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    /*public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }*/

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login($user, $manager=false , $encoded=false)
    {
        if ($user) {
            return Yii::$app->user->login($this->getUser($user, $manager), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    /*public function getUser($user)
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($user);
        }
        return $this->_user;
    }*/
    public function getUser($user, $manager)
    {
        $session = Yii::$app->getSession();

        if ($this->_user === false) {
            $this->_user = User::findByUsername($user);
        }

        if($manager) {
            $this->_user->manager = true;

            $managerLoginIndex = 'manager_login_'.$this->_user->id;
            $session->set($managerLoginIndex, true);
        }

        return $this->_user;
    }
    
    public function attributeLabels()
    {
    	return [
    	'username' => 'Shop Url',
    	];
    }
}
