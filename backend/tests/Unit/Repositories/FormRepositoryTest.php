<?php

namespace Tests\Unit\Repositories;

use App\Enum\UserType;
use App\Models\Form;
use App\Models\User;
use App\Repositories\FormRepository;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class FormRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $formRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->formRepository = new FormRepository;
    }

    public function test_get_all_forms()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => UserType::Customer->value]);
        $user->assignRole($role);
        $this->actingAs($user);

        Form::factory()->count(5)->create();
        $forms = $this->formRepository->getAll();
        $this->assertCount(5, $forms);
    }

    public function test_get_form_by_id()
    {
        $form = Form::factory()->create();
        $result = $this->formRepository->getById($form->id);

        $this->assertInstanceOf(Form::class, $result);
    }

    public function test_create_form()
    {
        $faker = Faker::create();
        $data = ['user_id' => User::factory()->create()->id, 'title' => $faker->sentence];

        $result = $this->formRepository->create($data);

        $this->assertInstanceOf(Form::class, $result);
    }

    public function test_update_form()
    {
        $faker = Faker::create();
        $data = ['title' => $faker->sentence];
        $form = Form::factory()->create();

        $result = $this->formRepository->update($form->id, $data);

        $this->assertInstanceOf(Form::class, $result);
    }

    public function test_delete_form()
    {
        $form = Form::factory()->create();

        $result = $this->formRepository->delete($form->id);

        $this->assertTrue($result);
    }
}
