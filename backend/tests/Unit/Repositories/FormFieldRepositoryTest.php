<?php

namespace Tests\Unit\Repositories;

use App\Enum\FieldType;
use App\Models\Form;
use App\Models\FormField;
use App\Repositories\FormFieldRepository;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormFieldRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $formRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->formRepository = new FormFieldRepository;
    }

    public function test_get_all_form_fields()
    {
        FormField::factory()->count(5)->create();
        $forms = $this->formRepository->getAll();
        $this->assertCount(5, $forms);
    }

    public function test_get_form_field_by_id()
    {
        $form = FormField::factory()->create();
        $result = $this->formRepository->getById($form->id);

        $this->assertInstanceOf(FormField::class, $result);
    }

    public function test_create_form_field()
    {
        $faker = Faker::create();
        $data = ['form_id' => Form::factory()->create()->id, 'label' => $faker->title(), 'type' => FieldType::text->value];

        $result = $this->formRepository->create($data);

        $this->assertInstanceOf(FormField::class, $result);
    }

    public function test_update_form_field()
    {
        $faker = Faker::create();
        $data = ['type' => FieldType::textarea->value];
        $form = FormField::factory()->create();

        $result = $this->formRepository->update($form->id, $data);

        $this->assertInstanceOf(FormField::class, $result);
    }

    public function test_delete_form_field()
    {
        $form = FormField::factory()->create();

        $result = $this->formRepository->delete($form->id);

        $this->assertTrue($result);
    }
}
