<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRequest()
    {
        $user = User::register(
            $name = 'name',
            $email = 'email',
            $password = 'password'
        );

        self::assertNotEmpty($user);
        self::assertEquals($name, $user->name);
        self::assertEquals($email, $user->email);

        self::assertNotEmpty($user->password);
        self::assertNotEquals($password, $user->password);

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());
        self::assertFalse($user->isAdmin());
//        $user->delete();
    }

    public function testVerify(){
        $user = User::register('name', 'email', 'password');
        $user->verify();

        self::assertFalse($user->isWait());
        self::assertTrue($user->isActive());
//        $user->delete();


    }

    public  function testAlreadyVerified(){
        $user = User::register('name', 'email', 'password');
        $user->verify();
        $this->expectExceptionMessage('User is already verified');
        $user->verify();
//        $user->delete();
    }
}
