<?php

use App\Models\Course;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('only returns released courses for released scope', function () {
    // arrange
    Course::factory()->released()->create();
    Course::factory()->create();

    // act and assert
    expect(Course::released()->get())
        ->toHaveCount(1)
        ->first()->id->toEqual(1);

});

it('has videos', function () {
    // arrange
    $course = Course::factory()->released()->create();
    $video = Video::factory()->count(3)->create([
        'course_id' => $course->id
    ]);

    // act and assert
    expect($course->videos)
        ->toHaveCount(3)
        ->each->toBeInstanceOf(Video::class);

});
