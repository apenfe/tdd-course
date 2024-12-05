<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('gives back successful response for homepage', function () {
    get(route('home'))
        ->assertOk();
});

it('gives back successful response for course details page', function () {
    // arrange
    $course = Course::factory()->create();

    // act
    get(route('course-details', $course))
        ->assertOk();
});
