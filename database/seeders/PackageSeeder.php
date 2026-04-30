<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Package::create([
            'name' => 'De Djawatan',
            'destination' => 'Banyuwangi',
            'price' => 200000,
            'image' => 'DeDjawatan_Card.jpg',
            'description' => 'Hutan legendaris dengan pepohonan trembesi raksasa yang diselimuti paku tanduk rusa, menciptakan suasana magis layaknya hutan di film Lord of the Rings.',
            'itinerary' => [
                "08.00 - Meeting Point",
                "09.00 - Explore Forest",
                "11.00 - Photo Session",
                "12.00 - Lunch Break"
            ],
            'is_popular' => true,
        ]);

        \App\Models\Package::create([
            'name' => 'Kawah Ijen',
            'destination' => 'Banyuwangi',
            'price' => 250000,
            'image' => 'Ijen_card.webp',
            'description' => 'Saksikan fenomena api biru yang langka dan danau asam berwarna toska yang memukau dari puncak gunung berapi yang aktif ini.',
            'itinerary' => [
                "00.30 - Start Trekking",
                "02.00 - Blue Fire",
                "04.00 - Sunrise",
                "06.00 - Lake View"
            ],
            'is_popular' => true,
        ]);

        \App\Models\Package::create([
            'name' => 'Pulau Merah',
            'destination' => 'Banyuwangi',
            'price' => 150000,
            'image' => 'PulauMerah_Card.jpg',
            'description' => 'Nikmati sunset terbaik di Banyuwangi dengan latar belakang bukit setinggi 200 meter yang memiliki tanah berwarna merah yang unik.',
            'itinerary' => [
                "14.00 - Arrival",
                "15.00 - Beach Activities",
                "17.30 - Sunset Viewing",
                "19.00 - Farewell"
            ],
            'is_popular' => true,
        ]);
    }
}
