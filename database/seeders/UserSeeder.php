<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*Admin*/
        $admin = new User([
            'name' => 'Admin',
            'email' => 'admin@azewbxjnaicpshuu.tzty.net',
            'password' => bcrypt('mzcoEoux'),
        ]);
        $admin->save();

        /*Haluk ÜNAL*/
        $admin = new User([
            'name' => 'Haluk ÜNAL',
            'email' => 'haluk@azewbxjnaicpshuu.tzty.net',
            'password' => bcrypt('iAJmncrk'),
        ]);
        $admin->save();

        /*Burak YILDIZ*/
        $admin = new User([
            'name' => 'Burak YILDIZ',
            'email' => 'burak@azewbxjnaicpshuu.tzty.net',
            'password' => bcrypt('5KkM6sR0'),
        ]);
        $admin->save();

        /*Sinan AYDOĞAN*/
        $admin = new User([
            'name' => 'Sinan AYDOĞAN',
            'email' => 'sinan@azewbxjnaicpshuu.tzty.net',
            'password' => bcrypt('km73g5N2'),
        ]);
        $admin->save();

        /*Barış BİDERATAN*/
        $admin = new User([
            'name' => 'Barış BİDERATAN',
            'email' => 'baris@azewbxjnaicpshuu.tzty.net',
            'password' => bcrypt('HeEGTNnA'),
        ]);
        $admin->save();
    }
}
