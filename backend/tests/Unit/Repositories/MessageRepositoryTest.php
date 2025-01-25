<?php

namespace Tests\Unit\Repositories;

use App\Models\Form;
use App\Models\Message;
use App\Models\User;
use App\Repositories\MessageRepository;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $messageRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->messageRepository = new MessageRepository;
    }

    public function test_get_all_forms()
    {
        Message::factory()->count(5)->create();
        $forms = $this->messageRepository->getAll();
        $this->assertCount(5, $forms);
    }

    public function test_get_form_by_id()
    {
        $form = Message::factory()->create();
        $result = $this->messageRepository->getById($form->id);

        $this->assertInstanceOf(Message::class, $result);
    }

    public function test_create_form()
    {
        $faker = Faker::create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'form_id' => Form::factory()->create()->id,
            'subject' => $faker->title,
            'body' => $faker->sentence,
        ];

        $result = $this->messageRepository->create($data);

        $this->assertInstanceOf(Message::class, $result);
    }

    public function test_update_form()
    {
        $faker = Faker::create();
        $data = ['body' => $faker->sentence];
        $form = Message::factory()->create();

        $result = $this->messageRepository->update($form->id, $data);

        $this->assertInstanceOf(Message::class, $result);
    }

    public function test_delete_form()
    {
        $form = Message::factory()->create();

        $result = $this->messageRepository->delete($form->id);

        $this->assertTrue($result);
    }
}
