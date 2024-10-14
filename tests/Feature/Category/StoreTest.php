<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\{assertDatabaseHas, postJson};

it('should be able to store a new category', function () {
    $user = User::factory()->admin()->create();

    Sanctum::actingAs($user);

    postJson(route('categories.store'), [
        'name' => 'Test Category',
    ])->assertSuccessful();

    assertDatabaseHas('categories', ['name' => 'Test Category']);
});

test('only admin should be able to store a new category', function () {
    $user = User::factory()->regularUser()->create();

    Sanctum::actingAs($user);

    postJson(route('categories.store'), [
        'name' => 'Test Category',
    ])->assertUnauthorized();

});

describe('validation rules', function () {
    test('name:required', function () {
        $user = User::factory()->admin()->create();

        Sanctum::actingAs($user);

        postJson(route('categories.store'), [
            'name' => '',
        ])->assertJsonValidationErrors([
            'name' => 'required',
        ]);
    });
});
