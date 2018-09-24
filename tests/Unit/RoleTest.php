<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testChange()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['role' => User::ROLE_USER]);

        self::assertFalse($user->isAdmin());
        $user->changeRole(User::ROLE_ADMIN);
        self::assertTrue($user->isAdmin());
    }

    public function testAlready()
    {
        $user = factory(User::class)->create(['role' => User::ROLE_ADMIN]);
        $this->expectExceptionMessage('Role is already assigned.');
        $user->changeRole(User::ROLE_ADMIN);
    }
}
