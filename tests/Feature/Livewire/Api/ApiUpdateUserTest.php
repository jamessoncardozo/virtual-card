<?php

namespace Tests\Feature\Livewire\Api;

use Faker\Factory as Faker;

use Tests\TestCase;

class ApiUpdateUserTest extends TestCase
{
  /** @test */

  //sudo php artisan test --filter ApiUpdateUserTest::the_api_can_put_one_user

  public function the_api_can_put_one_user(){

    $faker = Faker::create('pt_br');

    $this->json('PUT', '/api/user/24',['name' => $faker->name],)->assertStatus(200);
    
  }
}