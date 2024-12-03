<?php

use App\Models\{ClassificationType, User};
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\{assertDatabaseHas, postJson};

it('should be able to store a new classification type', function () {
    $user = User::factory()->admin()->create();

    Sanctum::actingAs($user);

    postJson(route('classification_types.store'), [
        'name' => 'Test Type',
    ])->assertSuccessful();

    assertDatabaseHas('classification_types', ['name' => 'Test Type']);
});

test('only admin should be able to store a new classification type', function () {
    $user = User::factory()->regularUser()->create();

    Sanctum::actingAs($user);

    postJson(route('classification_types.store'), [
        'name' => 'Test Type',
    ])->assertUnauthorized();
});

describe('validation rules', function () {
    test('name:required', function () {
        $user = User::factory()->admin()->create();

        Sanctum::actingAs($user);

        postJson(route('classification_types.store'))->assertJsonValidationErrors(['name' => 'required']);
    });

    test('name:string', function () {
        $user = User::factory()->admin()->create();

        Sanctum::actingAs($user);

        postJson(route('classification_types.store'), [
            'name' => 123,
        ])->assertJsonValidationErrors(['name' => 'string']);
    });
});

test('after creating we should return a status 201 with the created questions', function () {
    $user = User::factory()->admin()->create();

    Sanctum::actingAs($user);

    $request = postJson(route('classification_types.store'), [
        'name' => 'Test Type',
    ])->assertCreated();

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
