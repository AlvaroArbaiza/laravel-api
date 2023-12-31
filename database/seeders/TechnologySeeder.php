<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin\Technology;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            'Css',
            'Javascript',
            'Vue',
            'Vite',
            'PHP',
            'MySQL',
            'Laravel'
        ];

        foreach($technologies as $element) {
            $new_tech = new Technology();
            $new_tech->name = $element;
            $new_tech->slug = Str::slug( $new_tech->name , '-');
            $new_tech->save();
        }
    }
}
