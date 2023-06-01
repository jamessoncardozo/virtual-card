<?php

namespace Tests\Feature\Livewire\Api;

use Tests\TestCase;

class ApiGetAllUsersTest extends TestCase
{
  /** @test */

  //sudo php artisan test --filter ApiGetAllUsersTest::the_api_return_all_users

  public function the_api_return_all_users(){

    $this->json('get', '/api/users')->assertStatus(200);

  }
}

