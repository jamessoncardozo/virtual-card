<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\BuzProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BuzProfileTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(BuzProfile::class);

        $component->assertStatus(200);
    }
}
