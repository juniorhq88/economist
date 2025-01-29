<?php

namespace Database\Seeders;

use App\Enum\UserType;
use App\Models\Form;
use App\Models\FormField;
use App\Models\Message;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $faker = Faker::create();

        $user = User::factory()->create([
            'name' => 'Junior Hernandez',
            'email' => 'superadmin@economista.mx',
            'password' => Hash::make('Qwerty12345#'),
        ]);
        $user->assignRole(UserType::SuperAdmin->value);

        $user2 = User::factory()->create([
            'name' => 'Hanna',
            'email' => 'hanna@economista.mx',
            'password' => Hash::make('1234567890'),
        ]);
        $user2->assignRole(UserType::Customer->value);

        $user3 = User::factory()->create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => Hash::make('1234567890'),
        ]);
        $user3->assignRole(UserType::Customer->value);

        $user4 = User::factory()->create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => Hash::make('1234567890'),
        ]);
        $user4->assignRole(UserType::Customer->value);

        // Formulario
        $form = Form::factory()->create([
            'title' => 'Formulario de prueba',
            'description' => 'Formulario de prueba',
            'user_id' => $user2->id,
        ]);

        FormField::factory()->create([
            'form_id' => $form->id,
            'label' => 'Nombre',
            'type' => 'text',
            'value' => $faker->name(),
            'required' => 1,
            'order' => 1,
        ]);
        FormField::factory()->create([
            'form_id' => $form->id,
            'label' => 'Correo Electrónico',
            'type' => 'email',
            'value' => $faker->email,
            'required' => 1,
            'order' => 2,
        ]);

        FormField::factory()->create([
            'form_id' => $form->id,
            'label' => 'Teléfono',
            'type' => 'tel',
            'value' => $faker->phoneNumber(),
            'required' => 0,
            'order' => 3,
        ]);

        FormField::factory()->create([
            'form_id' => $form->id,
            'label' => 'Adjuntar Archivo',
            'type' => 'file',
            'value' => 'http://my-nice-file.pdf',
            'required' => 1,
            'order' => 4,
        ]);

        $formFields = FormField::where('form_id', $form->id)->get();
        $body = '';

        foreach ($formFields as $field) {
            $body = $body.$field->label.' '.$field->value;
        }

        $msg = Message::factory()->create([
            'user_id' => $user2->id,
            'form_id' => $form->id,
            'subject' => $faker->title(),
            'body' => $body,
        ]);

        Form::factory()->create([
            'title' => 'Formulario de prueba 2',
            'description' => $faker->sentence(),
            'user_id' => $user2->id,
        ]);

        $form2 = Form::factory()->create([
            'title' => 'Formulario de prueba 3',
            'description' => $faker->sentence(),
            'user_id' => $user3->id,
        ]);

        $form3 = Form::factory()->create([
            'title' => 'Formulario de prueba 4',
            'description' => $faker->sentence(),
            'user_id' => $user4->id,
        ]);

    }
}
