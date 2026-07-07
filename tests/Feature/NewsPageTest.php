<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_news_detail_page_loads(): void
    {
        $news = News::create([
            'title' => 'Test School News',
            'slug' => 'test-school-news',
            'excerpt' => 'A short preview of the article.',
            'body' => '<p>This is the article body.</p>',
            'is_published' => true,
            'is_featured' => false,
            'published_at' => now(),
        ]);

        $response = $this->get(route('news.show', $news));

        $response->assertOk();
        $response->assertSee($news->title);
    }
}
