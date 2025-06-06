<?php

namespace Database\Seeders;

use App\Models\{ClassifiableItem, Classification, User};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //        User::factory()->create([
        //            'name'  => 'Test User',
        //            'email' => 'test@example.com',
        //        ]);

        //        ClassifiableItem::factory(30)->create([
        //            'classification_type_id' => 2,
        //        ]);

        Classification::factory(900)->teacherClassifications()->create();
        Classification::factory(900)->disciplineClassifications()->create();
        Classification::factory(900)->placeClassifications()->create();

    }
}
