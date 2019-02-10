<?php
	
	namespace common\models\tables;
	
	use Yii;
	
	/**
	 * This is the model class for table "tasks_status".
	 *
	 * @property int $id
	 * @property string $title
	 *
	 * @property Tasks[] $tasks
	 * @property TaskStatus[] $list
	 */
	class TaskStatus extends \yii\db\ActiveRecord
	{
		/**
		 * {@inheritdoc}
		 */
		public static function tableName()
		{
			return 'tasks_status';
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function rules()
		{
			return [
				[['title'], 'required'],
				[['title'], 'string', 'max' => 25],
			];
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function attributeLabels()
		{
			return [
				'id' => 'ID',
				'title' => 'Title',
			];
		}
		
		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getTasks()
		{
			return $this->hasMany(Tasks::class, ['status' => 'id']);
		}
		
		/**
		 * @return array
		 */
		public static function getList()
		{
			return TaskStatus::find()->select(['title', 'id'])->indexBy('id')->column();
		}
	}
