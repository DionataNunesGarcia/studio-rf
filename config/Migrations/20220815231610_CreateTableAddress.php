<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTableAddress extends AbstractMigration
{
    public function up()
    {
        $this->table('address')
            ->addColumn('cep', 'string', [
                'limit' => 15,
                'null' => true,
            ])
            ->addColumn('street', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('number', 'string', [
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('district', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('complement', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('lat', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('long', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('city', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('uf', 'string', [
                'limit' => 2,
                'null' => true,
            ])
            ->addColumn('foreign_key', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('model', 'string', [
                'default' => null,
                'limit' => 255,
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
