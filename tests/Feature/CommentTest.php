<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Tests\TestCase;

class CommentTest extends TestCase
{

    public function testCreateCommentValidation()
    {
        $team = Team::first();

        $response = $this
            ->actingAs(User::first())
            ->post("/teams/$team->id/comments");

        $response->assertStatus(302);

        $response->assertInvalid([
            'content' => 'The content field is required.',
        ]);

        $response = $this
            ->actingAs(User::first())
            ->post("/teams/$team->id/comments", [
                'content' => 'aaa'
            ]);

        $response->assertInvalid([
            'content' => 'The content must be at least 10 characters.',
        ]);

        $response = $this
            ->actingAs(User::first())
            ->post("/teams/$team->id/comments", [
                'content' => 'aaaaaaaaaaa idiot'
            ]);

        $response->assertInvalid([
            'content' => 'The content cannot contain: hate, idiot, stupid',
        ]);
    }

    public function testCreateCommentSuccess()
    {
        $team = Team::first();

        $response = $this
            ->actingAs(User::first())
            ->post("/teams/$team->id/comments", [
                'content' => 'Valid comment content'
            ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas(
            'comments',
            [
                'content' => 'Valid comment content',
            ]
        );
    }
}
