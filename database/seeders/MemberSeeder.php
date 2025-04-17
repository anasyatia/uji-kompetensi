<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            // Generate unique member_code
            do {
                $memberCode = 'CDMBR-' . strtoupper(Str::random(6));
            } while (Member::where('member_code', $memberCode)->exists());

            Member::create([
                'nama' => $faker->name,
                'telp' => $this->generateIndonesianPhoneNumber(),
                'poin' => 0,
                'address' => $faker->address,
                'member_code' => $memberCode,
                'date_of_birth' => $faker->date('Y-m-d', '2005-01-01'),
                'email' => $faker->unique()->safeEmail,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // Simulate Indonesian phone number generator
    private function generateIndonesianPhoneNumber(): string
    {
        $prefixes = ['081', '082', '083', '085', '087', '089'];
        $prefix = $prefixes[array_rand($prefixes)];
        $number = $prefix . $this->randomDigits(8);
        return $number;
    }

    private function randomDigits($length)
    {
        $digits = '';
        for ($i = 0; $i < $length; $i++) {
            $digits .= mt_rand(0, 9);
        }
        return $digits;
    }
}
