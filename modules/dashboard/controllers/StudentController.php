<?php

namespace dashboard\controllers;

use Yii;
use dashboard\models\Students;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;


/**
 * StudentController handles student self-profile actions.
 */
class StudentController extends DashboardController
{
    public $permissions = [
        'dashboard-student-profile' => 'Manage Own Profile',
    ];

    public function getViewPath()
    {
        return Yii::getAlias('@ui/views/hms/student');
    }

    public function actionIndex()
    {
        Yii::$app->user->can('dashboard-student-profile');
    
        $userId = Yii::$app->user->id;
        $model = Students::find()->where(['user_id' => $userId])->one();
    
        if (!$model) {
            // Option 1: Throw an error
            // throw new NotFoundHttpException('Student profile not found.');
    
            // Option 2: Create new student profile record automatically
            $model = new Students();
            $model->user_id = $userId;
            $model->loadDefaultValues();
        }
    
        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate() && $model->save()) {
            Yii::$app->session->setFlash('success', 'Your profile has been updated.');
            return $this->redirect(['index']);
        }
    
        if ($this->request->isAjax) {
            return $this->renderAjax('profile', ['model' => $model]);
        }
    
        return $this->render('profile', ['model' => $model]);
    }
    
}
