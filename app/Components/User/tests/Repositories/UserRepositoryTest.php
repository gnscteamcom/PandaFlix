<?php

namespace App\Components\User\tests\Repositories;

use App\Components\Common\Testing\TestCase;
use App\Components\Common\Testing\Traits\UserTestCaseTrait;
use App\Components\User\Database\User;
use App\Components\User\Repositories\UserRepository;

/**
 * @group User
 */
class UserRepositoryTest extends TestCase
{
    use UserTestCaseTrait;

    /** @test */
    public function test_repository_returns_all_users(): void
    {
        $this->createUser(3);

        self::assertCount(3, (new UserRepository())->all());
    }

    /** @test */
    public function test_repository_returns_all_user_paginated(): void
    {
        // First run, 15 users
        $this->createUser(15);
        // Paginates 15 per page
        self::assertCount(15, (new UserRepository())->paginate());

        // Second run, add 15 for a total of 30 users
        $this->createUser(15);
        // Due to pagination, still 15 users on the first page
        self::assertCount(15, (new UserRepository())->paginate());
    }

    /** @test */
    public function test_repository_get_user_by_id(): void
    {
        $this->createUser(5);

        $userId = User::first()->id;
        $repo = new UserRepository();

        self::assertSame(
            $userId,
            $repo->getById($userId)->id
        );
    }
}
