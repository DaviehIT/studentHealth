<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-dashboard">
    <div class="row">
        <!-- Stat Cards -->
        <?= $this->render('_statBox', ['label' => 'Students', 'count' => $studentsCount, 'icon' => 'fa-user-graduate', 'color' => 'info']) ?>
        <?= $this->render('_statBox', ['label' => 'Patients', 'count' => $patientsCount, 'icon' => 'fa-users', 'color' => 'success']) ?>
        <?= $this->render('_statBox', ['label' => 'Appointments Today', 'count' => $appointmentsToday, 'icon' => 'fa-calendar-check', 'color' => 'primary']) ?>
        <?= $this->render('_statBox', ['label' => 'Medical Records', 'count' => $medicalRecords, 'icon' => 'fa-notes-medical', 'color' => 'warning']) ?>
        <?= $this->render('_statBox', ['label' => 'Low Stock Meds', 'count' => $lowStockMeds, 'icon' => 'fa-pills', 'color' => 'danger']) ?>
    </div>

    <div class="row mt-4 mb-4">
        <!-- Action Buttons Row -->
        <div class="col-md-3 mb-2">
            <?= Html::a('Patients Report', ['patients/export-pdf'], ['class' => 'btn btn-danger btn-block']) ?>
        </div>
        <div class="col-md-3 mb-2">
            <?= Html::a('Appointments Report', ['appointments/download-report'], ['class' => 'btn btn-warning btn-block']) ?>
        </div>
        <div class="col-md-3 mb-2">
            <?= Html::a('Pharmacy Report', ['pharmacy/download-report'], ['class' => 'btn btn-success btn-block']) ?>
        </div>
        <div class="col-md-3 mb-2">
            <?= Html::a('Medical Records Report', ['medical-records/download-report'], ['class' => 'btn btn-info btn-block']) ?>
        </div>
    </div>

    <div class="row">
        <!-- Charts -->
        <div class="col-md-6">
            <h5>Appointments Over Time</h5>
            <canvas id="appointmentsChart"></canvas>
        </div>
        <div class="col-md-6">
            <h5>Gender Distribution</h5>
            <canvas id="genderChart"></canvas>
        </div>
    </div>
</div>

<?php
$script = <<< JS
// Chart.js example init
const appointmentsChart = new Chart(document.getElementById('appointmentsChart'), {
    type: 'line',
    data: {
        labels: {$appointmentChart['labels']},
        datasets: [{
            label: 'Appointments',
            data: {$appointmentChart['data']},
            borderColor: 'blue',
            fill: true,
        }]
    }
});

const genderChart = new Chart(document.getElementById('genderChart'), {
    type: 'pie',
    data: {
        labels: ['Male', 'Female', 'Other'],
        datasets: [{
            data: {$genderData},
            backgroundColor: ['#4e73df', '#e74a3b', '#36b9cc']
        }]
    }
});
JS;

$this->registerJs($script);
?>
