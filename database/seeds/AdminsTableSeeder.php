<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Admin::truncate();

      Admin::create([
          'name' => "admin1",
          'email' => "admin1@admin.co.jp",
          'password' => Hash::make('adminadmin'),
      ]);
    }
}
