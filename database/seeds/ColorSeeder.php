<?php

use App\Color;
use App\Colors;
use App\ProductColor;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $color = [

            'WHITE'   =>  '#FFFFFF',
            'SILVER'  =>  '#C0C0C0',
            'GRAY'    =>  '#808080',
            'BLACK'   =>  '#000000',
            'RED'     =>  '#FF0000',
            'MAROON'  =>  '#800000',
            'YELLOW'  =>  '#FFFF00',
            'OLIVE'   =>  '#808000',
            'LIME'    =>  '#00FF00',
            'GREEN'   => '#008000',
            'AQUA'    =>  '#00FFFF',
            'TEAL'    =>  '#008080',
            'BLUE'    =>  '#0000FF',
            'NAVY'    =>  '#000080',
            'FUCHSIA' =>  '#FF00FF',
            'PURPLE'  =>  '#800080',

        ];


        foreach ($color as $color => $code) {
            Color::create([
                'color'  =>  $color,
                'hex_code'  =>  $code
            ]);
        } //-- end foreach

    } //-- end run function
}//-- end seeder
