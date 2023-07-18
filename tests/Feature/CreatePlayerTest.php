<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Player;
use Tests\TestCase;

class CreatePlayerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreatePlayer()
    {
        $user = factory(Player::class)->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);
    

        $this->assertDatabaseHas('players', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com'
        ]);
    }
}
