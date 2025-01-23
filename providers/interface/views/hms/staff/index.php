<?php

use dashboard\models\Staff;
use helpers\Html;
use yii\helpers\Url;
use helpers\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var dashboard\models\searches\StaffSearches $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Staff';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-index row">
    <div class="col-md-12">
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title"><?= Html::encode($this->title) ?> </h3>
          <div class="block-options">
          <?=  Html::customButton([
            'type' => 'modal',
            'url' => Url::to(['create']),
            'appearence' => [
              'type' => 'text',
              'text' => 'Add Staff',
              'theme' => 'primary',
              'visible' => Yii::$app->user->can('dashboard-staff-create', true)
            ],
            'modal' => ['title' => 'New Staff']
          ]) ?>
          </div> 
        </div>
        <div class="block-content">     
    <?php Pjax::begin(); ?>
    <div class="staff-search my-3">
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            
            [
              'attribute' => 'first_name',
              'value' => function($model) {
                  return  ($model? $model->first_name .' '. $model->last_name : 'No patient found');
              },
              'label' => 'Staff Info'
          ],
            
            'phone',
            'email:email',
            [
              'attribute' => 'department_id',
              'value' => function($model) {
                  return  ($model->department ? $model->department->name : 'No department found');
              },
              'label' => 'Department'
          ],
            //'address:ntext',
            //'department_id',
            //'role',
            //'is_deleted',
            //'created_at',
            //'updated_at',
            [
                'class' => \helpers\grid\ActionColumn::className(),
                'template' => '{update} {trash}',
                'headerOptions' => ['width' => '8%'],
                'contentOptions' => ['style'=>'text-align: center;'],
                 'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::customButton(['type' => 'modal', 'url' => Url::toRoute(['update', 'id' => $model->id]), 'modal' => ['title' => 'Update  Staff'], 'appearence' => ['icon' => 'edit', 'theme' => 'info']]);
                    },
                    'trash' => function ($url, $model, $key) {
                        return $model->is_deleted !== 1 ?
                            Html::customButton(['type' => 'link', 'url' => Url::toRoute(['trash', 'id' => $model->id]),  'appearence' => ['icon' => 'trash', 'theme' => 'danger', 'data' => ['message' => 'Do you want to delete this staff?']]]) :
                            Html::customButton(['type' => 'link', 'url' => Url::toRoute(['trash', 'id' => $model->id]),  'appearence' => ['icon' => 'undo', 'theme' => 'warning', 'data' => ['message' => 'Do you want to restore this staff?']]]);
                    },
                ],
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('dashboard-staff-update',true),
                    'trash' => function ($model){
                         return $model->is_deleted !== 1 ? 
                                Yii::$app->user->can('dashboard-staff-delete',true) : 
                                Yii::$app->user->can('dashboard-staff-restore',true);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
</div>
      </div>
    </div>