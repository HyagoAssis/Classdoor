<?php

use App\Models\{ClassifiableItem, ClassificationType, User};
use Illuminate\Validation\Rule;
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\{assertDatabaseHas, assertDatabaseMissing, postJson};

it('should be able to store a new classifiableItem', function () {
    $user = User::factory()->admin()->create();
    $type = ClassificationType::factory()->create();

    Sanctum::actingAs($user);

    postJson(route('classifiable_items.store'), [
        'name'                   => 'Joaquim de Souza',
        'classification_type_id' => $type->id,
    ])->assertSuccessful();

    assertDatabaseHas('classifiable_items', ['name' => 'Joaquim de Souza', 'classification_type_id' => $type->id]);
});

test('only logged user can store a new classifiableItem', function () {
    $type = ClassificationType::factory()->create();

    postJson(route('classifiable_items.store'), [
        'name'                   => 'Joaquim de Souza',
        'classification_type_id' => $type->id,
    ])->assertUnauthorized();

    assertDatabaseMissing('classifiable_items', ['name' => 'Joaquim de Souza', 'classification_type_id' => $type->id]);
});

describe('validation rules', function () {
    test('name:required', function () {
        $user = User::factory()->admin()->create();
        $type = ClassificationType::factory()->create();

        Sanctum::actingAs($user);

        postJson(route('classifiable_items.store'), [
            'classification_type_id' => $type->id,
        ])->assertJsonValidationErrors([
            'name' => 'required',
        ]);
    });

    test('name:unique', function () {
        $user = User::factory()->admin()->create();
        $type = ClassificationType::factory()->create();

        $user->classifiableItems()->create([
            'name'                   => 'Joaquim de Souza',
            'classification_type_id' => $type->id,
        ]);

        Sanctum::actingAs($user);

        postJson(route('classifiable_items.store'), [
            'name'                   => 'Joaquim de Souza',
            'classification_type_id' => $type->id,
        ])->assertJsonValidationErrors([
            'name' => Rule::unique('classifiable_items', 'name'),
        ]);
    });

    test('classification_type_id:required', function () {
        $user = User::factory()->admin()->create();

        Sanctum::actingAs($user);

        postJson(route('classifiable_items.store'), [
            'name' => 'Joaquim de Souza',
        ])->assertJsonValidationErrors([
            'classification_type_id' => 'required',
        ]);
    });

    test('classification_type_id:exists', function () {
        $user = User::factory()->admin()->create();

        Sanctum::actingAs($user);

        postJson(route('classifiable_items.store'), [
            'name'                   => 'Joaquim de Souza',
            'classification_type_id' => 1,
        ])->assertJsonValidationErrors([
            'classification_type_id' => Rule::exists('classification_types', 'id'),
        ]);
    });
});

test('after creating we should return a status 201 with the created classifiableItem', closure: function () {
    $user               = User::factory()->admin()->create();
    $classificationType = ClassificationType::factory()->create();

    Sanctum::actingAs($user);

    $request = postJson(route('classifiable_items.store'), [
        'name'                   => 'Joaquim de Souza',
        'classification_type_id' => $classificationType->id,
    ])->assertCreated();

    $classifiableItems = ClassifiableItem::latest()->first();

    $request->assertJson([
        'data' => [
            'id'                     => $classifiableItems->id,
            'name'                   => $classifiableItems->name,
            'classification_type_id' => $classificationType->id,
            'created_by'             => $classifiableItems->created_by,
            'created_at'             => $classificationType->created_at->toISOString(),
            'updated_at'             => $classificationType->updated_at->toISOString(),
        ],
    ]);
});
