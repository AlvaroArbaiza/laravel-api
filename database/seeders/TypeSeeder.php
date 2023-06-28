<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin\Type;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'FrontEnd',
            'Backend',
            'FullStack',
            'Design'
        ];

        foreach ($types as $element) {
            $new_type = new Type();
            $new_type->name = $element;
            $new_type->slug = Str::slug( $new_type->name , '-');
            $new_type->save();
        }
    }
}
