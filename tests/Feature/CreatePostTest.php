<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

       /** @test */
   public function test_authenticated_can_create_new_posts()
   {
    //check if the Posts table in empty
    $this->assertEquals(0,Post::count());

    //dummy data
    $dummyData =[
        'title'=>'the hard to still fire',
        'body'=>'don\'t giveUp any more'
    ];

    $this
    ->postJson(route('posts.store'),$dummyData)
    ->assertStatus(201);
    //cahke if the Posts table contains exactly one post
    $this->assertEquals(1,Post::count());

    //check what we sent was what was saved

    $post = Post::first();

    $this->assertEquals($dummyData['title'],$post->title);
    $this->assertEquals($dummyData['body'],$post->body);
    // Trust but verify
     
   }
}
