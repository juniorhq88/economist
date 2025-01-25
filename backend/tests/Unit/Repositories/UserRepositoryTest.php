<?php

namespace Tests\Unit\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository;
    }

    public function test_get_all_users()
    {
        User::factory()->count(5)->create();
        $users = $this->userRepository->getAll();
        $this->assertCount(5, $users);
    }

    public function test_get_user_by_id()
    {
        $user = User::factory()->create();
        $result = $this->userRepository->getById($user->id);

        $this->assertInstanceOf(User::class, $result);
    }

    public function test_create_user()
    {
        $data = ['name' => 'John Doe', 'email' => 'john@example.com', 'password' => 'password'];
        $result = $this->userRepository->create($data);

        $this->assertInstanceOf(User::class, $result);
    }

    public function test_update_user()
    {
        $data = ['name' => 'Jane Doe'];
        $user = User::factory()->create();

        $result = $this->userRepository->update($user->id, $data);

        $this->assertInstanceOf(User::class, $result);
    }

    public function test_delete_user()
    {
        $user = User::factory()->create();

        $result = $this->userRepository->delete($user->id);

        $this->assertTrue($result);
    }
}
