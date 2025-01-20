<?php

use yii\db\Migration;

/**
 * Class m250117_112108_hms_tables
 */
class m250117_112108_hms_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('patients', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(100)->notNull(),
            'last_name' => $this->string(100)->notNull(),
            'date_of_birth' => $this->date()->notNull(),
            'gender' => $this->string(10)->notNull()->check("gender IN ('Male', 'Female')"),


            'phone' => $this->string(15)->notNull(),
            'email' => $this->string(100),
            'address' => $this->text()->notNull(),
            'is_deleted' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ]);
        $this->createTable('appointment_status', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'is_deleted' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ]);
        $this->createTable('department', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),

            'is_deleted' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ]);

        $this->createTable('staff', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(100)->notNull(),
            'last_name' => $this->string(100)->notNull(),
            'phone' => $this->string(15)->notNull(),
            'email' => $this->string(100),
            'address' => $this->text()->notNull(),
            'department_id' => $this->integer()->notNull(),
            'role' => $this->string(50)->notNull(),
            'is_deleted' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

            'FOREIGN KEY ([[department_id]]) REFERENCES {{%department}} ([[id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ]);
        $this->createTable('appointments', [
            'id' => $this->primaryKey(),
            'patient_id' => $this->integer()->notNull(),
            'staff_id' => $this->integer()->notNull(),
            'appointment_date' => $this->date()->notNull(),
            'appointment_time' => $this->time()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'remarks' => $this->text(),
            'is_deleted' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

            'FOREIGN KEY ([[patient_id]]) REFERENCES {{%patients}} ([[id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
            'FOREIGN KEY ([[staff_id]]) REFERENCES {{%staff}} ([[id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
            'FOREIGN KEY ([[status_id]]) REFERENCES {{%appointment_status}} ([[id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ]);
     
        $this->createTable('medical_records', [
            'id' => $this->primaryKey(),
            'patient_id' => $this->integer()->notNull(),
            'staff_id' => $this->integer()->notNull(),
            'diagnosis' => $this->text()->notNull(),
            'treatment' => $this->text()->notNull(),
            'prescription' => $this->text(),
            'is_deleted' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

            'FOREIGN KEY ([[patient_id]]) REFERENCES {{%patients}} ([[id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
            'FOREIGN KEY ([[staff_id]]) REFERENCES {{%staff}} ([[id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ]);
        $this->createTable('pharmacy_inventory', [
            'id' => $this->primaryKey(),
            'medicine_name' => $this->string(255)->notNull(),
            'batch_number' => $this->string(100)->notNull(),
            'quantity' => $this->integer()->notNull(),
            'expiry_date' => $this->date()->notNull(),
            'unit_price' => $this->decimal(10, 2)->notNull(),
            'manufacturer' => $this->string(255),
            'is_deleted' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250117_112108_hms_tables cannot be reverted.\n";

        return false;
    }
    protected function buildFkClause($delete = '', $update = '')
    {
        return implode(' ', ['', $delete, $update]);
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250117_112108_hms_tables cannot be reverted.\n";

        return false;
    }
    */
}
