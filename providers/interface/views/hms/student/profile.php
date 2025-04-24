<?php
use helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var dashboard\models\Students $model */
use ui\bundles\DashboardAsset;

DashboardAsset::register($this);
?>


<div class="container py-4">
    <div class="card shadow-lg rounded">
        <div id="card-header" class="card-header text-white text-center">
            <h3 class="mb-0">Student Profile</h3>
            <small>Update your personal and academic details below</small>
        </div>

        <div class="card-body px-4 py-3">
            <?php $form = ActiveForm::begin([
                'options' => ['data-pjax' => true, 'class' => 'needs-validation'],
                'fieldConfig' => [
                    'template' => '<div class="form-group mb-3">{label}{input}{error}</div>',
                    'labelOptions' => ['class' => 'form-label fw-bold'],
                    'inputOptions' => ['class' => 'form-control'],
                    'errorOptions' => ['class' => 'text-danger small'],
                ],
            ]); ?>

            <!-- Section 1: Personal Information -->
            <h5 class="border-bottom pb-2 mb-3 text-primary">📘 Personal Information</h5>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'Enter your first name']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Enter your last name']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'dob')->input('date') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'gender')->dropDownList(
                        ['Male' => 'Male', 'Female' => 'Female'],
                        ['prompt' => 'Select Gender']
                    ) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'phone')->textInput(['placeholder' => '07XX XXX XXX']) ?>
                </div>
            </div>

            <!-- Section 2: Academic Information -->
            <h5 class="border-bottom pb-2 mt-4 mb-3 text-success">🎓 Academic Information</h5>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'registration_number')->textInput(['placeholder' => 'Your registration number']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'faculty')->textInput(['placeholder' => 'e.g. School of Engineering']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'course')->textInput(['placeholder' => 'e.g. BSc Computer Science']) ?>
                </div>
            
            </div>

            <!-- Optional: Admin only -->
       

            <div class="text-center mt-4">
                <?= Html::submitButton('<i class="fas fa-save me-2"></i>Update Profile', [
                    'class' => 'btn btn-success px-4 py-2'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
