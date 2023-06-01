<?php

namespace Tests\Feature\Livewire\Api;

use Tests\TestCase;

class ApiDelUserTest extends TestCase
{

  /** @test */

  //sudo php artisan test --filter ApiDelUserTest::the_api_can_del_one_user
  public function the_api_can_del_one_user(){

    $this->deleteJson('/api/user/32')->assertStatus(202);

  }
}

