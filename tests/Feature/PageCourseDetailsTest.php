<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows course details', function () {
    // arrange
    $course = Course::factory()->create([
        'tagline' => 'Course tagline',
        'image' => 'image.png',
        'learnings' => ['Learn laravel routes', 'Learn laravel views', 'Learn laravel commands'],
    ]);

    // act
    get(route('course-details', $course))
        ->assertOk()
        ->assertSeeText([
            $course->title,
            $course->description,
            'Course tagline',
            'Learn laravel routes',
            'Learn laravel views',
            'Learn laravel commands'
        ])
        ->assertSee('image.png');

    // assert
});

it('shows course video count', function () {
    // arrange

    // act

    // assert
});
