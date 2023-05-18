<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\GenerateBuzcard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class GenerateBuzcardTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(GenerateBuzcard::class);

        $component->assertStatus(200);
    }
}
