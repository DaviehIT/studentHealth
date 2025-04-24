<?php

use helpers\Html;
use helpers\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var dashboard\models\Patients $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="patients-form">
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'date_of_birth')->input('date') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'gender')->dropDownList([
                'Male' => 'Male',
                'Female' => 'Female',
                'Other' => 'Other',
            ], ['prompt' => 'Select Gender']) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="block-content block-content-full text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
