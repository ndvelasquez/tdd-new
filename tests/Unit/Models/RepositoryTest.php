<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Repository;
use App\Models\User;

class RepositoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_belongs_to_user()
    {
        $repository = Repository::factory()->create();

        $this->assertInstanceOf(User::class, $repository->user);
    }
}
