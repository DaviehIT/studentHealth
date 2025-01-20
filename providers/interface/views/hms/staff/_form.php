<?php

use helpers\Html;
use helpers\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var dashboard\models\Staff $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="staff-form">
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]);?>
    <div class="row">
        <div class="col-md-12">
          <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'department_id')->textInput() ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'role')->textInput(['maxlength' => true]) ?>
        </div>
    
    </div>
    <div class="block-content block-content-full text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
