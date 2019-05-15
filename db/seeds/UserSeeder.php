<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];

        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'title' => $faker->lastName,
                'content' => $faker->text,
                'created_at' => date('Y-m-d G:i:s'),
            ];
        }

        $forms = $this->table('forms');
        $forms->insert($data)
            ->save();
        $forms->truncate();
    }
}
