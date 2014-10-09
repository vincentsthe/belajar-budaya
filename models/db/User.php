<?php

namespace app\models\db;

use app\models\db\User;
use Yii;

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
            [['fb_access_token', 'fb_id'], 'required'],
            [['fb_access_token'], 'string', 'max' => 500],
            [['fb_id'],'string','max' => 100],
            [['score'],'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
        return $this->hasMany(RoomHasUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['id' => 'room_id'])->viaTable('{room_has_user}', ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByUsername($username){
        throw new Exception("Unsupported operation exception");
        
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

    
}
