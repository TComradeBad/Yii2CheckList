<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    const SCENARIO_LOGIN = "login";
    const SCENARIO_REGISTER = "register";

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            ["email", "email"],
            ["rememberMe", "boolean"],

            [["username", "email", "password"], "required", "on" => self::SCENARIO_REGISTER],
            [["email","username"],"isUnique","on"=>self::SCENARIO_REGISTER],
            [["username", "password"], "required", "on" => self::SCENARIO_LOGIN],
            ['password', 'validatePassword', "on" => self::SCENARIO_LOGIN],

        ];
    }


    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function isUnique($attribute, $params)
    {
        if(!$this->hasErrors()){
            $user = new User($this->getAttributes(["username","email","password"]));
            if(!$user->validate()){
                $this->addError($attribute,"User or email already exist");
            }
        }
    }


    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * creates new user after registration
     * @return User
     */
    public function register()
    {
        if($this->validate()){
            $user = new User($this->getAttributes(["username","email","password"]));
            $user->save();
        }
        return $user;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
