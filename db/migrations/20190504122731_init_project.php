<?php

use Phinx\Migration\AbstractMigration;

class InitProject extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('forms');
        $table->addColumn('title', 'char');
        $table->addColumn('content', 'text');
        $table->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP']);
        $table->create();
    }

//    CREATE TABLE `forms` (
//    `id` int(11) NOT NULL AUTO_INCREMENT,
//    `title` varchar(64) CHARACTER SET utf8 NOT NULL,
//    `content` text CHARACTER SET utf8 NOT NULL,
//    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//    PRIMARY KEY (`id`)
//    ) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
}
