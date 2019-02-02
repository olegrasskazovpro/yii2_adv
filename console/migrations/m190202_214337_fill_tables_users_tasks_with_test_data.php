<?php
	
	use yii\db\Migration;
	
	/**
	 * Class m190202_214337_fill_tables_users_tasks_with_test_data
	 */
	class m190202_214337_fill_tables_users_tasks_with_test_data extends Migration
	{
		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$hash = Yii::$app->getSecurity()->generatePasswordHash('qwerty123');
			Yii::$app->db->createCommand('ALTER TABLE task_adv.user AUTO_INCREMENT=0')->query();
			$this->batchInsert(
				'user',
				['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'],
				[
					['Petr', '', $hash, 'user1@test.ru', '1549102857', '1549102857'],
					['Olga', '', $hash, 'user2@test.ru', '1549102857', '1549102857'],
					['Igor', '', $hash, 'user3@test.ru', '1549102857', '1549102857'],
					['Elena', '', $hash, 'user4@test.ru', '1549102857', '1549102857'],
					['Vasily', '', $hash, 'user5@test.ru', '1549102857', '1549102857'],
					['Kot', '', $hash, 'user6@test.ru', '1549102857', '1549102857'],
					['Alex', '', $hash, 'user7@test.ru', '1549102857', '1549102857'],
					['Evgenii', '', $hash, 'user8@test.ru', '1549102857', '1549102857'],
					['Alexey', '', $hash, 'user9@test.ru', '1549102857', '1549102857'],
					['Galina', '', $hash, 'user10@test.ru', '1549102857', '1549102857'],
					['Artem', '', $hash, 'user11@test.ru', '1549102857', '1549102857'],
				]);
			
			Yii::$app->db->createCommand('ALTER TABLE task_adv.tasks AUTO_INCREMENT=0')->query();
			$this->batchInsert('tasks', ['title', 'description', 'responsible_id', 'created', 'status'], [
				['Task 1', 'Задача на миллион долларов', 1, date("Y-m-d H:i:s"), 1],
				['Task 2', 'Задача на миллион долларов', 1, date("Y-m-d H:i:s"), 2],
				['Task 3', 'Задача на миллион долларов', 2, date("Y-m-d H:i:s"), 2],
				['Task 4', 'Задача на миллион долларов', 2, date("Y-m-d H:i:s"), 2],
				['Task 5', 'Задача на миллион долларов', 2, date("Y-m-d H:i:s"), 2],
				['Task 6', 'Задача на миллион долларов', 3, date("Y-m-d H:i:s"), 1],
				['Task 7', 'Задача на миллион долларов', 4, date("Y-m-d H:i:s"), 3],
				['Task 8', 'Задача на миллион долларов', 4, date("Y-m-d H:i:s"), 4],
				['Task 9', 'Задача на миллион долларов', 4, date("Y-m-d H:i:s"), 5],
				['Task 10', 'Задача на миллион долларов', 5, date("Y-m-d H:i:s"), 6],
				['Task 11', 'Задача на миллион долларов', 5, date("Y-m-d H:i:s"), 1],
				['Task 12', 'Задача на миллион долларов', 6, date("Y-m-d H:i:s"), 1],
			]);
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$arr = Yii::$app->db->createCommand('SELECT id FROM tasks')->queryColumn();
			foreach ($arr as $id) {
				$this->delete('tasks', "id = {$id}");
			}
			Yii::$app->db->createCommand('ALTER TABLE task_adv.tasks AUTO_INCREMENT=0')->query();
			
			$arr = Yii::$app->db->createCommand('SELECT id FROM users')->queryColumn();
			foreach ($arr as $id) {
				$this->delete('user', "id = {$id}");
			}
			Yii::$app->db->createCommand('ALTER TABLE task_adv.user AUTO_INCREMENT=0')->query();
		}
		
		/*
		// Use up()/down() to run migration code without a transaction.
		public function up()
		{

		}

		public function down()
		{
				echo "m190202_214337_fill_tables_users_tasks_with_test_data cannot be reverted.\n";

				return false;
		}
		*/
	}
