<?php
	
	namespace backend\modules\admin\controllers;
	
	use Yii;
	use common\models\tables\User;
	use common\models\filters\UserSearch;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use yii\filters\VerbFilter;
	use common\models\tables\Roles;
	
	/**
	 * UsersController implements the CRUD actions for Users model.
	 */
	class UserController extends Controller
	{
		/**
		 * {@inheritdoc}
		 */
		public function behaviors()
		{
			return [
				'verbs' => [
					'class' => VerbFilter::class,
					'actions' => [
						'delete' => ['POST'],
					],
				],
			];
		}
		
		/**
		 * Lists all Users models.
		 * @return mixed
		 */
		public function actionIndex()
		{
			$searchModel = new UserSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}
		
		/**
		 * Displays a single Users model.
		 *
		 * @param integer $id
		 *
		 * @return mixed
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		public function actionView($id)
		{
			$model = $this->findModel($id);
			return $this->render('view', [
				'model' => $model,
				'role' => Roles::findOne($model->role_id),
			]);
		}
		
		/**
		 * Creates a new Users model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 * @return mixed
		 */
		public function actionCreate()
		{
			$model = new User();
			
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}
			
			return $this->render('create', [
				'model' => $model, 'list' => Roles::getList(),
			]);
		}
		
		/**
		 * Updates an existing Users model.
		 * If update is successful, the browser will be redirected to the 'view' page.
		 *
		 * @param integer $id
		 *
		 * @return mixed
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		public function actionUpdate($id)
		{
			$model = $this->findModel($id);
			
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}
			
			return $this->render('update', [
				'model' => $model, 'list' => Roles::getList(),
			]);
		}
		
		/**
		 * Deletes an existing Users model.
		 * If deletion is successful, the browser will be redirected to the 'index' page.
		 *
		 * @param integer $id
		 *
		 * @return mixed
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		public function actionDelete($id)
		{
			$this->findModel($id)->delete();
			
			return $this->redirect(['index']);
		}
		
		/**
		 * Finds the Users model based on its primary key value.
		 * If the model is not found, a 404 HTTP exception will be thrown.
		 *
		 * @param integer $id
		 *
		 * @return User the loaded model
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		protected function findModel($id)
		{
			if (($model = User::findOne($id)) !== null) {
				return $model;
			}
			
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
