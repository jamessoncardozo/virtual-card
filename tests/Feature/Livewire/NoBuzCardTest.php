<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\NoBuzCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class NoBuzCardTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(NoBuzCard::class);

        $component->assertStatus(200);
    }
}
