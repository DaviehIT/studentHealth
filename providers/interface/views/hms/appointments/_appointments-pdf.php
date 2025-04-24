

<h1>Appointments Report</h1>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Patient</th>
            <th>Staff</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($appointments)): ?>
        <?php foreach ($appointments as $appointment): ?>
        <tr>
            <td><?= $appointment->patient->first_name . ' ' . $appointment->patient->last_name ?></td>
            <td><?= isset($appointment->staff) ? $appointment->staff->first_name . ' ' . $appointment->staff->last_name : 'N/A' ?></td>
            <td><?= date('d-m-Y', strtotime($appointment->appointment_date)) ?></td>
            <td><?= date('H:i', strtotime($appointment->appointment_time)) ?></td>
            <td><?= $appointment->status->name ?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="5" style="text-align: center;">No appointments available.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
