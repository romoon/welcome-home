<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // 一括削除
      // User::truncate();

      //必要ならループ（ここをFactory使う）
      for ($k = 2; $k < 7; $k++) {
          User::create([
              'name' => "user" . $k,
              'nickname' => "user" . $k,
              'linetoken' => "hoge" . $k . "hoge" . $k,
              'email' => "user" . $k . "@user.co.jp",
              'password' => Hash::make('useruser'),
          ]);
      }

    }
}
