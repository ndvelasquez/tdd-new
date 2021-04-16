<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Repository;

class RepositoryControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    public function test_guest_redirection()
    {
        $this->get('repositories')->assertRedirect('login');            //index
        $this->get('repositories/1')->assertRedirect('login');          //show
        $this->get('repositories/create')->assertRedirect('login');   //create
        $this->put('repositories/1')->assertRedirect('login');          //update
        $this->get('repositories/1/edit')->assertRedirect('login');     //edit
        $this->delete('repositories/1')->assertRedirect('login');       //delete
        $this->post('repositories')->assertRedirect('login');           //store
    }

    public function test_index_without_data()
    {
        Repository::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->get('repositories')
            ->assertStatus(200)
            ->assertSee('No hay repositorios creados');
    }

    public function test_index_with_data()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $this
            ->actingAs($user)
            ->get('repositories')
            ->assertStatus(200)
            ->assertSee($repository->id)
            ->assertSee($repository->url);
    }

    public function test_show()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $this
            ->actingAs($user)
            ->get("repositories/$repository->id")
            ->assertStatus(200);
    }

    public function test_store()
    {
        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text
        ];

        $user = User::factory()->create();

        $this
        ->actingAs($user)
        ->post('repositories', $data)
        ->assertRedirect('repositories');

        $this->assertDatabaseHas('repositories', $data);
    }

    public function test_update()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text
        ];

        $this
        ->actingAs($user)
        ->put("repositories/{$repository->id}", $data)
        ->assertRedirect("repositories/{$repository->id}/edit");

        $this->assertDatabaseHas('repositories', $data);
    }

    public function test_delete()
    {
        $repository = Repository::factory()->create();

        $user = User::factory()->create();

        $this
        ->actingAs($user)
        ->delete("repositories/{$repository->id}")
        ->assertRedirect('repositories');

        $this->assertDatabaseMissing('repositories', [
            'id' => $repository->id,
            'url' => $repository->url,
            'description' => $repository->description
        ]);
    }

    public function test_store_validation()
    {
        $user = User::factory()->create();

        $this
        ->actingAs($user)
        ->post('repositories', [])
        ->assertStatus(302)
        ->assertSessionHasErrors(['url', 'description']);
    }

    public function test_update_validation()
    {
        $repository = Repository::factory()->create();

        $user = User::factory()->create();

        $this
        ->actingAs($user)
        ->put("repositories/{$repository->id}", [])
        ->assertStatus(302)
        ->assertSessionHasErrors(['url', 'description']);
    }

    public function test_update_policy()
    {
        $repository = Repository::factory()->create();

        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text
        ];

        $user = User::factory()->create();

        $this
        ->actingAs($user)
        ->put("repositories/{$repository->id}", $data)
        ->assertStatus(403);
    }

    public function test_show_policy()
    {
        $repository = Repository::factory()->create();
        $user = User::factory()->create();

        $this
        ->actingAs($user)
        ->get("repositories/{$repository->id}")
        ->assertStatus(403);
    }
}
