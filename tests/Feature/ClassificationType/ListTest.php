<?php

use App\Models\{ClassificationType, User};
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\getJson;

it('should be able to list classification types', function () {
    Sanctum::actingAs(User::factory()->admin()->create());

    $classificationType = ClassificationType::factory()->create();

    $request = getJson(route('classification_types.index'))
        ->assertOk();

    $request->assertJsonFragment([
        'id'         => $classificationType->id,
        'name'       => $classificationType->name,
        'created_at' => $classificationType->created_at,
        'updated_at' => $classificationType->updated_at,
        'deleted_at' => $classificationType->deleted_at,
    ]);
});

test('only admin should be able to list classification types', function () {
    Sanctum::actingAs(User::factory()->regularUser()->create());

    ClassificationType::factory()->create();

    getJson(route('classification_types.index'))
        ->assertUnauthorized();
});
