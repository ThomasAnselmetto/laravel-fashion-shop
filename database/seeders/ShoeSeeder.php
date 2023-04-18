<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Shoe;

class ShoeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 30; $i++) {
            $shoe = new Shoe;
            $shoe->model = $faker->name();
            $shoe->type = $faker->company();
            $shoe->number = $faker->randomNumber(2);
            $shoe->color = $faker->colorName();
            $shoe->quantity = $faker->randomNumber(2);
            //$shoe->image = $faker->imageUrl();

            $shoe->save();
        };
    }
}
