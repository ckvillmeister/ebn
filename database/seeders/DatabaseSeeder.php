<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FSMRContentSeeder::class);
        $this->call(AttachmentTypesSeeder::class);
        $this->call(FireSystemDeviceCategoriesSeeder::class);
        $this->call(FireSystemDevicesSeeder::class);
        $this->call(FireEmergencyExitRoutesChecklistSeeder::class);
        $this->call(FireSuppressionSystemChecklistSeeder::class);
        $this->call(SignatoriesSeeder::class);
        $this->call(DefaultSettings::class);
        $this->call(AssessmentSeeder::class);
        $this->call(FireSuppressionEquipmentsSeeder::class);
        $this->call(RecommendationsSeeder::class);
    }
}
