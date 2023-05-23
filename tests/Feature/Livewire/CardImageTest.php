<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\CardImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CardImageTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(CardImage::class);

        $component->assertStatus(200);
    }
}
