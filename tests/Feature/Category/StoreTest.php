<?php

use App\Models\{ClassificationType, User};
use Illuminate\Validation\Rule;
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\{assertDatabaseHas, postJson};

it('should be able to store a new category', function () {
    $user               = User::factory()->admin()->create();
    $classificationType = ClassificationType::factory()->create();

    Sanctum::actingAs($user);

    postJson(route('categories.store'), [
        'name'                   => 'Test Category',
        'classification_type_id' => $classificationType->id,
    ])->assertSuccessful();

    assertDatabaseHas('categories', ['name' => 'Test Category', 'classification_type_id' => $classificationType->id]);
});

test('only admin should be able to store a new category', function () {
    $user               = User::factory()->regularUser()->create();
    $classificationType = ClassificationType::factory()->create();

    Sanctum::actingAs($user);

    postJson(route('categories.store'), [
        'name' => 'Test Category', 'classification_type_id' => $classificationType->id,
    ])->assertUnauthorized();

});

describe('validation rules', function () {
    test('name:required', function () {
        $user               = User::factory()->admin()->create();
        $classificationType = ClassificationType::factory()->create();

        Sanctum::actingAs($user);

        postJson(route('categories.store'), [
            'classification_type_id' => $classificationType->id,
        ])->assertJsonValidationErrors([
            'name' => 'required',
        ]);
    });

    test('classification_type_id:required', function () {
        $user = User::factory()->admin()->create();

        Sanctum::actingAs($user);

        postJson(route('categories.store'), [
            'name' => 'Test Category',
        ])->assertJsonValidationErrors([
            'classification_type_id' => 'required',
        ]);
    });

    test('classification_type_id:exists', function () {
        $user = User::factory()->admin()->create();

        Sanctum::actingAs($user);

        postJson(route('categories.store'), [
            'name'                   => 'Test Category',
            'classification_type_id' => 999,
        ])->assertJsonValidationErrors([
            'classification_type_id' => Rule::exists('classification_types', 'id'),
        ]);
    });
});
