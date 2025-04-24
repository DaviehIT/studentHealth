<?php
/** @var $medicalRecords \dashboard\models\MedicalRecords[] */

// Ensure $medicalRecords is initialized properly
if (!isset($medicalRecords) || !is_array($medicalRecords)) {
    $medicalRecords = [];
}
?>

<h1>Medical Records Report</h1>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Diagnosis</th>
            <th>Treatment</th>
            <th>Prescription</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($medicalRecords as $record): ?>
        <tr>
            <td><?= $record->diagnosis ?></td>
            <td><?= $record->treatment ?></td>
            <td><?= $record->prescription ?></td>
            <td><?= date('d-m-Y', strtotime($record->created_at)) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
