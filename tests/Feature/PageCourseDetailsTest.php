<?php

use App\Models\Course;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('does not find unreleased courses', function () {
    // arrange
    $course = Course::factory()->create();

    // act and assert
    get(route('course-details'))
        ->assertOk()
        ->assertNotFound();

});

it('shows course details', function () {
    // arrange
    $course = Course::factory()->released()->create();

    // act and assert
    get(route('course-details', $course))
        ->assertOk()
        ->assertSeeText([
            $course->title,
            $course->description,
            $course->tagline,
            ...$course->learnings,
        ])
        ->assertSee(asset("images/{$course->image_name}"));

});

it('shows course video count', function () {
    // arrange
    $course = Course::factory()
        ->released()
        ->has(Video::factory()->count(3))
        ->create();

    // act and assert
    get(route('course-details', $course))
        ->assertOk()
        ->assertSeeText('3 videos');
});
