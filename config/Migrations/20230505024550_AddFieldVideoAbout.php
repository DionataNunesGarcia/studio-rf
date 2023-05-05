<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddFieldVideoAbout extends AbstractMigration
{
    /**
     * @return void
     */
    public function up()
    {
        $this->table('about')
            ->addColumn('video_home', 'string', [
                'limit' => 255,
                'after' => 'facebook',
                'null' => true,
            ])
            ->update();
    }

    /**
     * @return void
     */
    public function down()
    {
        $this->table('about')
            ->removeColumn('video_home')
            ->update();
    }
}
