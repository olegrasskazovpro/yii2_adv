<?php
	
	namespace common\models\tables;
	
	use yii\behaviors\TimestampBehavior;
	use yii\db\Expression;
	use Yii;
	
	/**
	 * This is the model class for table "tasks".
	 *
	 * @property int $id
	 * @property string $title
	 * @property string $description
	 * @property int $responsible_id
	 * @property string $deadline
	 * @property string $created
	 * @property string $updated
	 * @property int $status
	 *
	 * @property User $responsible
	 * @property TaskStatus $taskStatus
	 */
	class Tasks extends \yii\db\ActiveRecord
	{
		public function behaviors()
		{
			return [
				'timestamp' => [
					'class' => TimestampBehavior::class,
					'createdAtAttribute' => 'created',
					'updatedAtAttribute' => 'updated',
					'value' => new Expression('NOW()'),
				]
			];
		}
		
		
		/**
		 * {@inheritdoc}
		 */
		public static function tableName()
		{
			return 'tasks';
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function rules()
		{
			return [
				[['title', 'responsible_id', 'status'], 'required'],
				[['title'], 'string', 'max' => 80],
				[['description'], 'string'],
				[['responsible_id', 'status'], 'integer'],
				['deadline', 'string'],
				[['created', 'updated'], 'safe'],
				[['responsible_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['responsible_id' => 'id']],
				[['status'], 'exist', 'skipOnError' => true, 'targetClass' => TaskStatus::class, 'targetAttribute' => ['status' => 'id']],
			];
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function attributeLabels()
		{
			return [
				'id' => 'ID',
				'title' => Yii::t('main-Task', 'title'),
				'description' => Yii::t('main-Task', 'description'),
				'responsible_id' => Yii::t('main-Task', 'responsible'),
				'deadline' => Yii::t('main-Task', 'deadline'),
				'created' => Yii::t('main-Task', 'created'),
				'updated' => Yii::t('main-Task', 'updated'),
				'status' => Yii::t('main-Task', 'status'),
			];
		}
		
		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getTaskStatus()
		{
			return $this->hasOne(TaskStatus::class, ['id' => 'status']);
		}
		
		public function getResponsible()
		{
			return $this->hasOne(User::class, ['id' => 'responsible_id']);
		}
	}
