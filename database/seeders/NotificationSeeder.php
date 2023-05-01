<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::insert([
            [
                'name' => 'Cửa Hàng A',
                'email' => 'amaisoftstore@gmail.com',
                'phone' => '0788048699',
                'address'=>'Hà Nội',
                'map'=>'<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1003407.3418837192!2d105.60705088113612!3d10.768359452738313!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174cb8f2ebcfbe9%3A0xf52521cf14700506!2zUGhvbmcgQXBwbGUgLSBI4buHIFRo4buRbmcgSXBob25lIELhur9uIEPDoXQ!5e0!3m2!1svi!2s!4v1680148548270!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
            ],
        ]);
    }
}
