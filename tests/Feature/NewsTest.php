<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\Team;
use App\Models\User;
use Tests\TestCase;

// Naziv klase mora zavrsavati sa Test
class NewsTest extends TestCase
{
    public function testListNewsUnathenticated()
    {
        $response = $this->get('/news');

        $response->assertStatus(302);
    }

    
    public function testListNewsAuthenticated()
    {
        $response = $this
            ->actingAs(User::first())
            ->get('/news');

        $response->assertViewHas('allNews', News::with('user')->latest()->paginate(10));
        $response->assertViewHas('allTeams', Team::get());
        $response->assertViewIs('news.index');
        $response->assertStatus(200);
    }

    
    public function testShowSingleNews()
    {
        $news = News::first();

        $response = $this
            ->actingAs(User::first())
            ->get('/news/' . $news->id);

        $response->assertViewHas('news', $news);
        $response->assertViewIs('news.show');
        $response->assertStatus(200);
    }

    
    public function testCreateNewsValidationFailure()
    {
        $user = User::first();

        $response = $this
            ->actingAs($user)
            ->get('/news/create');

        $response->assertViewIs('news.create');
        $response->assertStatus(200);

        $response = $this
            ->actingAs($user)
            ->post('/news/create');

        $response->assertSessionHasErrors([
            'title',
            'content',
            'teams',
        ]);
        $response->assertStatus(302);
    }


    public function testCreateNewsSuccess()
    {
        $user = User::first();

        $response = $this
            ->actingAs($user)
            ->get('/news/create');

        $response->assertViewIs('news.create');
        $response->assertStatus(200);

        $response = $this
            ->actingAs($user)
            ->post('/news/create', [
                'title' => 'Test news title',
                'content' => 'Test news content',
                'teams' => [1, 2]
            ]);

        $this->assertDatabaseHas(
            'news',
            [
                'title' => 'Test news title',
                'content' => 'Test news content'
            ]
        );

        $response->assertStatus(302);
    }
}
