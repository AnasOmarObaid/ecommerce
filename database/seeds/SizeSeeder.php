<?php

use App\Size;
use Illuminate\Database\Seeder;


class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = ['XL', 'L', 'M', 'S', 'XS'];

        foreach ($sizes as $size) {
            Size::create([
                'name'  =>  $size,
            ]);
        } //-- end foreach
    } //-- end run
}//-- end size seeder
