<?php

namespace Tests\Feature\Livewire\Api;

use App\Http\Livewire\Api\ApiBuzCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ApiBuzCardTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ApiBuzCard::class);

        $component->assertStatus(200);
    }
}
