<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class TaskCest
{
    public function checkTaskIndex(AcceptanceTester $I)
    {
			$I->amGoingTo('Test Task index page');
			$I->amOnPage(Url::toRoute('/site/index'));
			$I->wait(2);
			$I->seeLink('Tasks');
			$I->click('Tasks');
			$I->dontSeeElement('.error');
			$I->see('Create task', '.btn');
			$I->seeElement('.task-container');
			$I->wait(2);
    }
	
	public function checkTaskCreate(AcceptanceTester $I)
	{
		$I->amGoingTo('Test Task creation');
		$I->amOnPage(Url::toRoute('/task'));
		$I->click('Create task');
		$I->seeInCurrentUrl('/task/create');
		$I->dontSeeElement('.error');
		$I->dontSeeElement('.has-error');
		$I->canSeeInField('Tasks[title]', '');
		$I->canSeeInField('Tasks[description]', '');
		$I->canSeeInField('Tasks[responsible_id]', 'Choose');
		$I->canSeeInField('Tasks[deadline]', '');
		$I->canSeeInField('Tasks[status]', 'Choose');
		$I->see('Save', '.btn-success');
		$I->wait(2); // задержка
		
		$I->wantToTest('Task creation with not filling required fields');
		$I->click('Save');
		$I->wait(2); // задержка
		$I->seeElement('.has-error');
		$I->see('Title cannot be blank', '.help-block');
		$I->see('Responsible cannot be blank', '.help-block');
		$I->see('Status cannot be blank', '.help-block');
		
		$I->wantToTest('New Task creation');
		$I->fillField('Tasks[title]', 'Тестовая задача');
		$I->wait(1); // задержка
		$I->fillField('Tasks[description]', 'Описание подробное задачи');
		$I->wait(1); // задержка
		$I->selectOption('Tasks[responsible_id]','Olga');
		$I->wait(1); // задержка
		$I->selectOption('Tasks[status]','New');
		$I->wait(1); // задержка
		$I->click('Save');
		$I->wait(2); // задержка
		$I->seeInCurrentUrl('/task-edit');
		$I->see('Тестовая задача', 'h1');
		$I->wait(3); // задержка
	}
}
