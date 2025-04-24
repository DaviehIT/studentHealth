<?php use yii\helpers\Html; ?>
<h2>Patients Report</h2>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Phone</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($patients as $i => $patient): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= Html::encode($patient->first_name . ' ' . $patient->last_name) ?></td>
                <td><?= Html::encode($patient->gender) ?></td>
                <td><?= Html::encode($patient->date_of_birth) ?></td>
                <td><?= Html::encode($patient->phone) ?></td>
                <td><?= Html::encode($patient->email) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
