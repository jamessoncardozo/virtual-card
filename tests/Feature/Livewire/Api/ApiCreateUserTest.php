<?php

namespace Tests\Feature\Livewire\Api;

use Faker\Factory as Faker;

use Tests\TestCase;

class ApiCreateUserTest extends TestCase
{

  //sudo php artisan test --filter ApiCreateUserTest::the_api_can_add_one_user
  
  /** @test */

  public function the_api_can_add_one_user(){

    $this->withoutExceptionHandling();

    $faker = Faker::create('pt_BR'); //Used just to take a fake name

    $this->json('POST','/api/users',['name' => $faker->name,])->assertStatus(201);

  }
}