<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\db\User;

/**
 * LoginForm is the model behind the login form.
 */
class FacebookLoginForm extends Model
{
    public $fb_id;
    public $fb_access_token;
    public $email;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['fb_id', 'fb_access_token','email'], 'required'],
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

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*12 : 0);
        } else {
            return false;
        }
    }

    public function loginByAccessToken(){
        if ($this->validate()){
            return Yii::$app->user->loginByAccessToken($this->fb_access_token);
        } else {
            return false;
        }
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

    public function save(){
        $userModel = User::find(['fb_id' => $this->fb_id])->one();

        if ($userModel === null){
            $userModel = new User;
        }
        $userModel->fb_id = $this->fb_id; $userModel->fb_access_token = $this->fb_access_token;
        if ($userModel->save()){
            return true;
        } else {
            return false;
        }
    }
}
