<?php

namespace Tests\Feature;

use App\Models\User;
use App\Rules\IsValidPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register()
    {
        // try {
            $this->withoutExceptionHandling();

            $response = $this->post(env('APP_URL').'api/auth/register', [
                'name'                   => 'John Doe',
                'email'                  => 'john.doe@gmail.com',
                'password'               => 'User@171996',
                'password_confirmation'  => 'User@171996',
            ]);

            $response->assertStatus(200);
            // $response->assertJson([
            //     'message'                => 'Registration successful',
            // ]);

            $this->assertDatabaseHas('users', [
                'name'                   => 'John Doe',
                'email'                  => 'john.doe@gmail.com',
            ]);
            // Output message indicating successful test execution
            echo "
                \r =======================================================
                \r Test Passed: User registration completed successfully.
                \r =======================================================
            ";
        // } catch (\Exception $th) {
        //     echo "
        //         \r =========================================
        //         \r Test Failed: " . $th->getMessage() ."
        //         \r =========================================
        //     ";
        //     $this->assertStringStartsWith('Validation Error', $th->getMessage());
        // }
    }
    /** @test */
    public function user_cannot_register()
    {
        $this->withoutExceptionHandling();

        $response = $this->post(env('APP_URL').'api/auth/register', [
            'name'                   => '',
            'email'                  => 'john.doe@gmail.com',
            'password'               => 'User@171996',
            'password_confirmation'  => 'User@171996',
        ]);

        $response->assertStatus(422);
        // $response->assertJson([
        //     'message'                => 'Registration successful',
        // ]);

        $this->assertDatabaseHas('users', [
            'name'                   => 'John Doe',
            'email'                  => 'john.doe@gmail.com',
        ]);
        // Output message indicating successful test execution
        echo "
            \r =======================================================
            \r Test Passed: User registration Error.
            \r =======================================================
        ";
        // $this->assertStringStartsWith('Validation Error', "");
    }
    /** @test */
    public function user_can_login()
    {
            $this->withoutExceptionHandling();
            User::factory()->create([
                'name'                  => 'John Doe',
                'email'                 => 'john.doe@gmail.com',
                'password'              => bcrypt('User@171996'),
            ]);

            $response = $this->post(env('APP_URL').'api/auth/login', [
                'email'                 => 'john.doe@gmail.com',
                'password'              => 'User@171996',
            ]);

            $response->assertStatus(200);
            $response->assertJson([
                'message' => 'Login successful',
            ]);
            $response->assertJsonStructure([
                'data' => [
                    'user' => [
                        'name',
                        'email',
                    ],
                    'access_token',
                ],
            ]);

    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials()
    {
            $this->withoutExceptionHandling();
            $user = User::factory()->create([
                'email'                 => 'john.dow@gmail.com',
                'password'              => bcrypt('password'),
            ]);

        $response = $this->post(env('APP_URL').'api/auth/login', [
            'email'                  => 'john.dow@gmail.com',
            'password'               => 'wrong-password',
        ]);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'your credentials doesn\'t match our records',
        ]);
        $this->assertGuest();
    }
}
