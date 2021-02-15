<?php


use Phinx\Seed\AbstractSeed;

class DocSeeder extends AbstractSeed
{

    public function run()
    {
        $faker = Faker\Factory::create();

        $data = [];

        for($i = 0; $i < 100; $i++){
            $data[] = [
                'title' => $faker->word,
                'content' => $faker->text($maxNbChars = 200)
            ];
        }

        $this->insert('forms', $data);
    }
}
