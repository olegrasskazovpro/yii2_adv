<?php

namespace frontend\controllers;

use common\models\tables\TaskAttachments;
use common\models\tables\TaskComments;
use Yii;
use common\models\tables\Tasks;
use common\models\tables\TaskStatus;
use common\models\tables\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;

class TaskController extends Controller
{
	public function actionIndex ()
	{
		$model = new Tasks();
		$query = $model::find();
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
		
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'model' => $model,
		]);
	}
	
	public function actionCreate()
	{
		$model = new Tasks();
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['one', 'id' => $model->id]);
		}
		
		return $this->render('create', [
			'model' => $model	,
			'userList' => User::getList(),
			'statusList' => TaskStatus::getList(),
		]);
	}
	
	public function actionOne($id)
	{
		$model = Tasks::findOne($id);
		$userId = Yii::$app->user->id ? Yii::$app->user->id : 1;
		
		$modelComment = new TaskComments();
		$queryComments = $modelComment::find()->where(['task_id' => $id]);
		$dataProvider = new ActiveDataProvider([
			'query' => $queryComments,
		]);
		
		$modelUpload = new TaskAttachments();
		$queryAttachments = $modelUpload::find()->where(['task_id' => $id]);
		$imgDataProvider = new ActiveDataProvider([
			'query' => $queryAttachments,
		]);
		
		return $this->render('one', [
			'model' => Tasks::findOne($id),
			'userList' => User::getList(),
			'statusList' => TaskStatus::getList(),
			
			'dataProvider' => $dataProvider,
			'imgDataProvider' => $imgDataProvider,
			'status' => $model->taskStatus->title,
			'responsible' => $model->responsible->username,
			'userId' => $userId,
			'modelComment' => $modelComment,
			'modelUpload' => $modelUpload,
		]);
	}
	
	public function actionSave($id)
	{
		$model = Tasks::findOne($id);
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->session->setFlash('success', Yii::t('main-Success', 'task-saved'));
		} else {
			Yii::$app->session->setFlash('error', Yii::t('main-Errors', 'task-not-saved'));
		}
		
		$this->redirect(Yii::$app->request->referrer);
	}
	
	/**
	 * Save new comment to DB
	 */
	public function actionAddComment()
	{
		$model = new TaskComments();
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->session->setFlash('success', Yii::t('main-Success', 'comment-saved'));
		} else {
			Yii::$app->session->setFlash('error', Yii::t('main-Errors', 'comment-not-saved'));
		}
		
		$this->redirect(Yii::$app->request->referrer);
	}
	
	/**
	 * Save uploaded file to folder, creates miniature of img, save file info to DB
	 */
	public function actionAddFile()
	{
		$model = new TaskAttachments();
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->file = UploadedFile::getInstance($model, 'file');
			if(!empty($model->file)){
				$model->upload();
				Yii::$app->session->setFlash('success', Yii::t('main-Success', 'file-uploaded'));
			}
		} else {
			Yii::$app->session->setFlash('error', Yii::t('main-Errors', 'file-not-uploaded'));
		}
		
		$this->redirect(Yii::$app->request->referrer);
	}
}