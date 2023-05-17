<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Generate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class GenerateTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Generate::class);

        $component->assertStatus(200);
    }
}
