<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddTableSlidesHome extends AbstractMigration
{
    public function up()
    {
        $this->table('slides_home')
            ->addColumn('title', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('subtitle', 'string', [
                'limit' => 255,
                'null' => true,
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
        $this->table('slides_home')
            ->drop()
            ->save();
    }
}
