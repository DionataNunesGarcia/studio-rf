<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddSpecialistConfigs extends AbstractMigration
{
    /**
     * @return void
     */
    public function up()
    {
        $this->table('specialists')
            ->addColumn('consultation_duration', 'integer', [
                'default' => '50',
                'limit' => 11,
                'null' => false,
                'after' => 'user_id',
            ])
            ->addColumn('start_service', 'time', [
                'default' => '08:00',
                'null' => false,
                'after' => 'consultation_duration',
            ])
            ->addColumn('end_service', 'time', [
                'default' => '19:00',
                'null' => false,
                'after' => 'start_service',
            ])
            ->addColumn('start_break', 'time', [
                'default' => '12:00',
                'null' => false,
                'after' => 'end_service',
            ])
            ->addColumn('end_break', 'time', [
                'default' => '13:00',
                'null' => false,
                'after' => 'start_break',
            ])
            ->addColumn('days_of_week', 'json', [
                'null' => false,
                'after' => 'end_break',
            ])
            ->update();
    }

    /**
     * @return void
     */
    public function down()
    {
        $this->table('specialists')
            ->removeColumn('consultation_duration')
            ->removeColumn('start_service')
            ->removeColumn('end_service')
            ->removeColumn('start_break')
            ->removeColumn('end_break')
            ->removeColumn('days_of_week')
            ->update();
    }
}
