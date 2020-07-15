<?php

use Illuminate\Database\Seeder;
use App\Editorial;

class EditorialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    // Editoriales
    //Editorial::truncate();

        // Editorial #1
        $editorial = new Editorial();
        $editorial->nombre = "Gnome Press";
        $editorial->save();
        // Editorial #2
        $editorial = new Editorial();
        $editorial->nombre = "Garbo";
        $editorial->save();
        // Editorial #3
        $editorial = new Editorial();
        $editorial->nombre = "Viking Press";
        $editorial->save();
        // Editorial #4
        $editorial = new Editorial();
        $editorial->nombre = "Bloomsbury Publishing";
        $editorial->save();
        // Editorial #5
        $editorial = new Editorial();
        $editorial->nombre = "EditorialNoAsignada";
        $editorial->save();
    }
}
