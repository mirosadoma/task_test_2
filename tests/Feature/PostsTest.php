<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Rules\IsValidPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_post(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'name'                  => 'Amr',
            'email'                 => 'amrmohamed171996@gmail.com',
            'password'              => bcrypt('User@171996'),
        ]);
        $post = Post::factory()->create([
            'title'             => 'Test Post',
            'description'       => 'Using Laravel, create a simple classified Ads backend, implementing the following user stories:
                                    • As a user I can register with the webapp using email and name.
                                    • As a user, I can login to the application.
                                    • As an authenticated user, I can create a post (ad) with a required title, description, and
                                    contact phone number. Description is limited to 2 KB in size.
                                    • As an authenticated user, I can upload an image for a created post. This image might be
                                    huge, so it should be processed in the background.
                                    • As a user, I can see a paginated list of posts created by other users. The list includes the
                                    title and description of each post limited to 512 characters, and sorted so that most
                                    recent posts appear first.
                                    • As an authenticated user, I can view any post. The view should include all information in
                                    addition to the user name who posted it.
                                    You are expected to develop a Web Api backend only. All API',
            'phone_number'      => '01276069689',
            'user_id'           => $user->id,
            'image'             => NULL,
        ]);
        $this->assertNotEmpty($post);
        // Output message indicating successful test execution
        echo "
            \r =======================================================
            \r Test Passed: User add post completed successfully.
            \r =======================================================
        ";
    }
    /** @test */
    public function user_can_update_post(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'name'                  => 'Amr',
            'email'                 => 'amrmohamed171996@gmail.com',
            'password'              => bcrypt('User@171996'),
        ]);
        $post = Post::factory()->create([
            'title'             => 'Test Post',
            'description'       => 'Using Laravel In All API',
            'phone_number'      => '01276069689',
            'user_id'           => $user->id,
            'image'             => NULL,
        ]);

        $is_updated = $post->update([
            'title'             => 'Test Post',
            'description'       => 'Using Laravel, create a simple classified Ads backend, implementing the following user stories:
                                    • As a user I can register with the webapp using email and name.
                                    • As a user, I can login to the application.
                                    • As an authenticated user, I can create a post (ad) with a required title, description, and
                                    contact phone number. Description is limited to 2 KB in size.
                                    • As an authenticated user, I can upload an image for a created post. This image might be
                                    huge, so it should be processed in the background.
                                    • As a user, I can see a paginated list of posts created by other users. The list includes the
                                    title and description of each post limited to 512 characters, and sorted so that most
                                    recent posts appear first.
                                    • As an authenticated user, I can view any post. The view should include all information in
                                    addition to the user name who posted it.
                                    You are expected to develop a Web Api backend only. All API',
            'phone_number'      => '01276069689',
            'user_id'           => $user->id,
            'image'             => NULL,
        ]);

        $this->assertTrue($is_updated);
        // Output message indicating successful test execution
        echo "
            \r =======================================================
            \r Test Passed: User update post completed successfully.
            \r =======================================================
        ";
    }
    /** @test */
    public function user_can_delete_post(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'name'                  => 'Amr',
            'email'                 => 'amrmohamed171996@gmail.com',
            'password'              => bcrypt('User@171996'),
        ]);
        $post = Post::factory()->create([
            'title'             => 'Test Post',
            'description'       => 'Using Laravel In All API',
            'phone_number'      => '01276069689',
            'user_id'           => $user->id,
            'image'             => NULL,
        ]);

        $is_deleted = $post->delete();

        $this->assertTrue($is_deleted);
        // Output message indicating successful test execution
        echo "
            \r =======================================================
            \r Test Passed: User delete post completed successfully.
            \r =======================================================
        ";
    }
}
