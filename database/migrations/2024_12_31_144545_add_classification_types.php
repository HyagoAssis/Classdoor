<?php

use App\Models\ClassificationType;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $data = [
            ['name' => 'Professor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Disciplina', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Local', 'created_at' => now(), 'updated_at' => now()],
        ];

        ClassificationType::insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
