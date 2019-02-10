<?php

namespace common\models\tables;

use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $role_id
 *
 * @property Tasks[] $tasks
 * @property Roles[] $roles
 * @property User[] $list
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'role_id'], 'required'],
            [['username', 'email', 'password'], 'string', 'max' => 25],
            [['role_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
					'id' => 'ID',
					'username' => 'Username',
					'email' => 'E-mail',
					'password' => 'Password',
					'role_id' => 'Role ID',
        ];
    }

    public function fields()
		{
			return [
				'id',
				'username' => 'login',
				'email',
				'password',
				'role_id',
			];
		}

	/**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::class, ['responsible_id' => 'id']);
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRoles()
	{
		return $this->hasMany(Roles::class, ['role_id' => 'id']);
	}

	public static function getList()
	{
		return User::find()->select(['username', 'id'])->indexBy('id')->column();
	}
	
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}
	
	public function validateAuthKey($authKey)
	{
		return $this->authKey === $authKey;
	}
	public function getAuthKey(){
		return $this->authKey;
	}
	public function getId()
	{
		return $this->id;
	}
	
	public static function findIdentityByAccessToken($token, $type = null)
	{
		return static::findOne(['access_token' => $token]);
	}
}
