<?php
	
	use yii\db\Migration;
	
	/**
	 * Handles the creation of table `{{%roles}}`.
	 */
	class m190202_220934_create_roles_table extends Migration
	{
		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->createTable('{{%roles}}', [
				'id' => $this->primaryKey(),
				'title' => $this->string(),
			]);
			
			$this->createIndex('ix_roles_id', '{{%roles}}', 'id');
			$this->batchInsert('{{%roles}}', ['title'], [
				['Админ'], ['Юзер'], ['Модератор']
			]);
			
			
			$this->addColumn('user', 'role_id', 'INT');
			$this->update('user', ['role_id' => 1], "id = 1");
			$this->update('user', ['role_id' => 2], "id > 1");
			
			$this->addForeignKey(
				'fk_users_role_id',
				'user',
				'role_id',
				'{{%roles}}',
				'id',
				'RESTRICT',
				'CASCADE'
			);
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$this->dropForeignKey('fk_users_role_id', 'user');
			$this->dropColumn('user', 'role_id');
			$this->dropTable('{{%roles}}');
		}
	}
