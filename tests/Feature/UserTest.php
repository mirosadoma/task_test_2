<?php

namespace Tests\Feature;

use App\Models\User;
use App\Rules\IsValidPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register(){
        $this->withoutExceptionHandling();

        $response = $this->post(env('APP_URL').'api/auth/register', [
            'name'                   => 'John Doe',
            'email'                  => 'john.doe@gmail.com',
            'password'               => 'User@171996',
            'password_confirmation'  => 'User@171996',
        ]);

        $response->assertStatus(200);
        // Output message indicating successful test execution
        echo "
            \r =======================================================
            \r Test Passed: User registration completed successfully.
            \r =======================================================
        ";
    }
    /** @test */
    public function user_cannot_register(){
        $this->withoutExceptionHandling();
        try {
            $response = $this->post(env('APP_URL').'api/auth/register', [
                'name'                   => '',
                'email'                  => 'john.doe@gmail.com',
                'password'               => 'User@171996',
                'password_confirmation'  => 'User@171996',
            ]);
            $this->assertEquals(422, $response->getStatusCode());
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Ensure that the exception has a status code of 422
            $this->assertEquals(422, $e->status);
            // Output message indicating successful test execution
            echo "
                \r =======================================================
                \r Test Passed: User registration Error.
                \r =======================================================
            ";
        }
    }
    /** @test */
    public function user_can_login(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'name'                  => 'John Doe',
            'email'                 => 'john.doe@gmail.com',
            'password'              => bcrypt('User@171996'),
        ]);

        $response = $this->post(env('APP_URL').'api/auth/login', [
            'email'                 => $user->email,
            'password'              => 'User@171996',
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(200);
        // Output message indicating successful test execution
        echo "
            \r =======================================================
            \r Test Passed: User login completed successfully.
            \r =======================================================
        ";
    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials()
    {
        $this->withoutExceptionHandling();
        try {
            $user = User::factory()->create([
                'email'                 => 'john.dow@gmail.com',
                'password'              => bcrypt('User@171996'),
            ]);
            $response = $this->post(env('APP_URL').'api/auth/login', [
                'email'                  => $user->email,
                'password'               => 'test',
            ]);
            $this->assertEquals(422, $response->getStatusCode());
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Ensure that the exception has a status code of 422
            $this->assertEquals(422, $e->status);
            // Output message indicating successful test execution
            echo "
                \r =======================================================
                \r Test Passed: User login Error.
                \r =======================================================
            ";
        }
    }
}
