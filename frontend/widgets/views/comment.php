<?php
	
	/**
	 * @var $model \common\models\tables\TaskComments
	 */
?>
<div class="comment-container">
	<p><span><?= $model->user->username ?>:</span></p>
	<p><?= $model->comment ?></p>
</div>