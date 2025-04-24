<?php

namespace dashboard\controllers;
use Mpdf\Mpdf;
use Yii;
use dashboard\models\Appointments;
use dashboard\models\searches\AppointmentsSearches;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;

/**
 * AppointmentsController implements the CRUD actions for Appointments model.
 */
class AppointmentsController extends DashboardController
{
    public $permissions = [
        'dashboard-appointments-list'=>'View Appointments List',
        'dashboard-appointments-create'=>'Add Appointments',
        'dashboard-appointments-update'=>'Edit Appointments',
        'dashboard-appointments-delete'=>'Delete Appointments',
        'dashboard-appointments-restore'=>'Restore Appointments',
        ];

        public function getViewPath()
        {
            return Yii::getAlias('@ui/views/hms/appointments');
        }       
    public function actionIndex()
    {
        Yii::$app->user->can('dashboard-appointments-list');
        $searchModel = new AppointmentsSearches();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('dashboard-appointments-create');
        $model = new Appointments();
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Appointments created successfully');
                        return $this->redirect(['index']);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        if ($this->request->isAjax) {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
    }
    public function actionUpdate($id)
    {
        Yii::$app->user->can('dashboard-appointments-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Appointments updated successfully');
                        return $this->redirect(['index']);
                    }
                }
            }
        }
       if ($this->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionView($id)
    {
        Yii::$app->user->can('dashboard-appointments-list');
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        if ($model->is_deleted) {
            Yii::$app->user->can('dashboard-appointments-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'Appointments has been restored');
        } else {
            Yii::$app->user->can('dashboard-appointments-delete');
            $model->delete();
            Yii::$app->session->setFlash('success', 'Appointments has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Appointments::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionDownloadReport()
{
    // Yii::$app->user->can('dashboard-appointments-report');
    $appointments = Appointments::find()->all();

    $mpdf = new Mpdf();

    // Set Header
    $mpdf->SetHeader('TUM Wellness Centre Appointments Report||Generated on: {DATE j-m-Y}');

    // Set Footer
    $mpdf->SetFooter('Page {PAGENO} of {nb}');

    // Content
    $html = $this->renderPartial('_appointments-pdf', [
        'appointments' => $appointments,
    ]);

    $mpdf->WriteHTML($html);
    $mpdf->Output('appointments-report.pdf', 'I');
}

}
