<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\BuzCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BuzCardTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(BuzCard::class);

        $component->assertStatus(200);
    }
}
