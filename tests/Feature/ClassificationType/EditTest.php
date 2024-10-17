<?php

use App\Models\{ClassificationType, User};
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\{assertDatabaseHas, putJson};

it('should be able to update a classification type', function () {
    $user               = User::factory()->admin()->create();
    $classificationType = ClassificationType::factory()->create();

    Sanctum::actingAs($user);

    putJson(route('classification_types.update', $classificationType), [
        'name' => 'Test Type 2',
    ])->assertOk();

    assertDatabaseHas('classification_types', [
        'id'   => $classificationType->id,
        'name' => 'Test Type 2',
    ]);
});

test('only admin should be able to update a classification type', function () {
    $user               = User::factory()->regularUser()->create();
    $classificationType = ClassificationType::factory()->create();

    Sanctum::actingAs($user);

    putJson(route('classification_types.update', $classificationType), [
        'name' => 'Test Type 2',
    ])->assertUnauthorized();
});

describe('validation rules', function () {
    test('name:required', function () {
        $user               = User::factory()->admin()->create();
        $classificationType = ClassificationType::factory()->create();

        Sanctum::actingAs($user);

        putJson(route('classification_types.update', $classificationType), [
            'name' => '',
        ])->assertJsonValidationErrors([
            'name' => 'required',
        ]);
    });

    test('string:required', function () {
        $user               = User::factory()->admin()->create();
        $classificationType = ClassificationType::factory()->create();

        Sanctum::actingAs($user);

        putJson(route('classification_types.update', $classificationType), [
            'name' => 123,
        ])->assertJsonValidationErrors([
            'name' => 'string',
        ]);
    });
});

test('after updating we should return a status 201 with the created questions', function () {
    $user               = User::factory()->admin()->create();
    $classificationType = ClassificationType::factory()->create();

    Sanctum::actingAs($user);

    $request = putJson(route('classification_types.update', $classificationType), [
        'name' => 'Test Type 2',
    ])->assertOk();

    $classificationType = ClassificationType::latest()->first();

    $request->assertJson([
        'data' => [
            'id'         => $classificationType->id,
            'name'       => $classificationType->name,
            'created_at' => $classificationType->created_at->toISOString(),
            'updated_at' => $classificationType->updated_at->toISOString(),
        ],
    ]);
});
