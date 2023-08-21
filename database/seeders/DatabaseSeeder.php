<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Channel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $channels = [
            [
                'name' => 'Kanał sportowy',
                'description' => 'Kanał informujący o wszystkich wydarzeniach sportowych z całego świata',
                'slug' => 'sport'
            ],
            [
                'name' => 'Kanał kultura',
                'description' => 'Kanał z wiadomościami kulturalnymi',
                'slug' => 'culture'
            ],
            [
                'name' => 'Kanał pogodowy',
                'description' => 'Prognoza pogody',
                'slug' => 'weather'
            ],
        ];

        foreach ($channels as $channel)
        {
            Channel::updateOrCreate(
                ['slug' => $channel['slug']],
                $channel
            );
        }
    }
}
