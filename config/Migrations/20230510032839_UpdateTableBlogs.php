<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class UpdateTableBlogs extends AbstractMigration
{
    /**
     * @return void
     */
    public function up()
    {
        $this->table('blogs')
            ->changeColumn('title', 'string', [
                'limit' => 255,
            ])
            ->changeColumn('subtitle', 'string', [
                'limit' => 255,
            ])
            ->changeColumn('slug', 'string', [
                'limit' => 255,
            ])
            ->changeColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->changeColumn('blog_category_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->update();
    }

    /**
     * @return void
     */
    public function down()
    {
    }
}
