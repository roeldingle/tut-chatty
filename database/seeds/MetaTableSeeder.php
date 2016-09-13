<?php

use Illuminate\Database\Seeder;
use App\Models\Meta;

class MetaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meta1 = new Meta();
        $meta1->key = 'fname';
        $meta1->label = 'First name';
        $meta1->type = 'text';
        $meta1->save();
        

        $meta2 = new Meta();
        $meta2->key = 'lname';
        $meta2->label = 'Last name';
        $meta2->type = 'text';
        $meta2->save();
        

        $meta3 = new Meta();
        $meta3->key = 'gender';
        $meta3->label = 'Gender';
        $meta3->type = 'radio';
        $meta3->save();

        $meta3 = new Meta();
        $meta3->key = 'avatar';
        $meta3->label = 'Avatar';
        $meta3->type = 'text';
        $meta3->save();
        
    }
}
