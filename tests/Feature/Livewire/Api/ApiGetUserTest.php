<?php

namespace Tests\Feature\Livewire\Api;

use Tests\TestCase;

class ApiGetUserTest extends TestCase
{
  /** @test */

  //sudo php artisan test --filter ApiGetUserTest::the_api_return_one_user

  public function the_api_return_one_user(){
    
    $this->json('get', '/api/user/24')->assertStatus(200);

  }

}

