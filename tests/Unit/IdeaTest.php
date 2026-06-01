<?php

use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

test('It Belong to a User', function () {
    $idea = Idea::factory()->create();

    expect($idea->user)->toBeInstanceOf(User::class);
});

test('It can have steps', function () {
    $idea = Idea::factory()->create();

    expect($idea->steps)->toBeEmpty();

    $idea->steps()->create([
        'description' => 'Step 1',
    ]);

    $idea->refresh();

    expect($idea->steps)->toHaveCount(1);
    expect($idea->steps)->toBeInstanceOf(Collection::class);
    expect($idea->steps->first()->description)->toBe('Step 1');
    expect($idea->steps->first()->completed)->toBe(false);
});
