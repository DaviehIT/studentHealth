<?php

use yii\db\Migration;

class m250409_060316_seeding extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $now = time();

        // Seed departments
        $this->insert('department', [
            'name' => 'General',
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $this->insert('department', [
            'name' => 'Mental Health',
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $this->insert('department', [
            'name' => 'Pharmacy',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        // Seed appointment statuses
        $this->insert('appointment_status', [
            'name' => 'Pending',
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $this->insert('appointment_status', [
            'name' => 'Confirmed',
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $this->insert('appointment_status', [
            'name' => 'Completed',
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $this->insert('appointment_status', [
            'name' => 'Cancelled',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        // Seed students
        $this->insert('students', [
            'user_id' => 212504001 	,
            'registration_number' => 'TUM/CS/001/2023',
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'gender' => 'Female',
            'dob' => '2002-05-15',
            'phone' => '0712345678',
            'faculty' => 'Computing',
            'course' => 'Computer Science',
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $this->insert('students', [
            'user_id' => 212504001 	,
            'registration_number' => 'TUM/IT/002/2023',
            'first_name' => 'John',
            'last_name' => 'Smith',
            'gender' => 'Male',
            'dob' => '2001-11-20',
            'phone' => '0798765432',
            'faculty' => 'Computing',
            'course' => 'Information Technology',
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250409_060316_seeding cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250409_060316_seeding cannot be reverted.\n";

        return false;
    }
    */
}
