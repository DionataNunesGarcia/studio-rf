<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTableTherapyBenefits extends AbstractMigration
{
    public function up()
    {
        $this->table('therapy_benefits')
            ->addColumn('title', 'string', [
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('subtitle', 'string', [
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

        $this->table('blogs_categories')
            ->addColumn('show_website', 'boolean', [
                'default' => true,
                'null' => false,
                'after' => 'status',
            ])
            ->update();
    }

    public function down()
    {
        $this->table('therapy_benefits')
            ->drop()
            ->save();

        $this->table('blogs_categories')
            ->removeColumn('show_website')
            ->update();
    }
}
