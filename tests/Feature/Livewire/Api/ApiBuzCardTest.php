<?php

namespace Tests\Feature\Livewire\Api;

use App\Http\Livewire\Api\ApiBuzCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ApiBuzCardTest extends TestCase
{
  //use RefreshDatabase;
    /** @test */
    public function the_api_return_all_users(){
      
      Http::fake();
      
      $response=Http::get(route('api.users'));

      $this->assertEquals(true,$response->successful());

    }
  
    public function the_component_can_render()
    {
        $component = Livewire::test(ApiBuzCard::class);

        $component->assertStatus(200);
        
    }
}
