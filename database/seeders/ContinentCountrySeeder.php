<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContinentCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing data
        DB::table('package_includes')->delete();
        DB::table('bookings')->delete();
        DB::table('packages')->delete();
        DB::table('places')->delete();
        DB::table('countries')->delete();
        DB::table('continents')->delete();

        // Define continents and their countries
        $continentsData = [
            'Asia' => ['Nepal', 'Maldives', 'Srilanka', 'Malaysia', 'Singapore'],
            'Europe' => ['Finland', 'France', 'Germany', 'Italy', 'Malta', 'Portugal'],
            'Middle East' => ['Bahrain', 'Iran', 'Jordan', 'Kuwait', 'Oman', 'Qatar']
        ];

        foreach ($continentsData as $continentName => $countries) {
            // Create continent
            $continentSlug = Str::slug($continentName);
            $continentId = DB::table('continents')->insertGetId([
                'name' => $continentName,
                'slug' => $continentSlug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create countries for this continent
            foreach ($countries as $countryName) {
                DB::table('countries')->insert([
                    'continent_id' => $continentId,
                    'name' => $countryName,
                    'slug' => Str::slug($countryName),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Add Bangladesh separately (from your original data)
        $asiaContinent = DB::table('continents')->where('slug', 'asia')->first();
        if ($asiaContinent) {
            DB::table('countries')->insert([
                'continent_id' => $asiaContinent->id,
                'name' => 'Bangladesh',
                'slug' => 'bangladesh',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Continents and countries seeded successfully!');
    }
}
