<?php

namespace app\models\db;

use Yii;

use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use yii\web\Session;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $fb_access_token
 * @property string $email
 *
 * @property Answer[] $answers
 * @property RoomHasUser[] $roomHasUsers
 * @property Room[] $rooms
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nick_name', 'full_name', 'email', 'fb_access_token', 'fb_id'], 'required'],
            [['score'], 'integer'],
            [['nick_name', 'full_name', 'email', 'fb_id'], 'string', 'max' => 100],
            [['fb_access_token'], 'string', 'max' => 500],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nick_name' => 'Nick Name', 
            'full_name' => 'Full Name', 
            'email' => 'Email', 
            'fb_access_token' => 'Fb Access Token',
            'fb_id' => 'Facebook Id',
            'score' => 'Skor'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomHasUsers()
    {
        return $this->hasMany(RoomUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['id' => 'room_id'])->viaTable('room_user', ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByUsername($email){
        return static::find(['email' => $email])->one();
        //throw new Exception("Unsupported operation exception");
        
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find(['fb_access_token' => $token])->one();
    }

    public function getAuthKey(){
    	return $this->fb_access_token;
    }

    public function validateAuthKey($authKey){
    	return $authKey === $this->fb_access_token;
    }

    public function getId(){
    	return $this->id;
    }
    
    /**
     * @param GraphObject $fbUser
     * @param FacebookSession $session
     */
    public function setFacebookUser($fbUser,$session,$image_url){
        $this->nick_name  = $fbUser->getProperty('first_name');
        $this->full_name = $fbUser->getProperty('name');
        $this->email = $fbUser->getProperty('email');
        $this->fb_access_token = $session->getToken();
        $this->fb_id = $fbUser->getProperty('id');
        $this->image_url = $image_url;
    }
}
