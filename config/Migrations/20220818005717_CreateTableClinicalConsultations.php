<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTableClinicalConsultations extends AbstractMigration
{
    public function up()
    {
        $this->table('consultations')
            ->addColumn('patient_id', 'integer', [
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('specialist_id', 'integer', [
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'limit' => \Phinx\Db\Adapter\MysqlAdapter::TEXT_LONG,
                'null' => false,
            ])
            ->addColumn('date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('value', 'decimal', [
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 2,
            ])
            ->addColumn('amount_paid', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 10,
                'scale' => 2,
            ])
            ->addColumn('date_paid', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('status', 'integer', [
                'default' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {
        $this->table('address')
            ->drop()
            ->save();
    }
}
