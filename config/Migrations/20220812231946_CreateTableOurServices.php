<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTableOurServices extends AbstractMigration
{
    public function up()
    {
        $this->table('our_services')
            ->addColumn('name', 'string', [
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('slug', 'string', [
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('status', 'integer', [
                'default' => 0,
                'null' => false,
            ])
            ->addColumn('content', 'text', [
                'limit' => \Phinx\Db\Adapter\MysqlAdapter::TEXT_LONG,
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
        $this->table('our_services')
            ->drop()
            ->save();
    }
}
