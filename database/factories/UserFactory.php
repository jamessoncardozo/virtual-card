<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $name = $this->faker->unique()->name();
      $user_name = Str::slug($name,'');
      $github = 'https://www.github.com/'.Str::slug($name,'');
      $linkedin = 'https://www.linkedin.com/in/'.Str::slug($name,'');
      
      return [
          'name' => $name,
          'email' => $this->faker->unique()->safeEmail(),
          'email_verified_at' => $this->faker->date($format = 'd-m-Y', $max = 'now'),
          'created_at' => $this->faker->date($format = 'd-m-Y', $max = 'now'),
          'updated_at' => $this->faker->date($format = 'd-m-Y', $max = 'now'),
          'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
          'remember_token' => Str::random(10),
          'profile_photo_path' => null,
          'current_team_id' => null,
          'user_name' => $user_name,
          'github_url' => $github,
          'linkedin_url' => $linkedin,
          'my_history' => $this->faker->text(500)
      ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     */
    public function withPersonalTeam(callable $callback = null): static
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(fn (array $attributes, User $user) => [
                    'name' => $user->name.'\'s Team',
                    'user_id' => $user->id,
                    'personal_team' => true,
                ])
                ->when(is_callable($callback), $callback),
            'ownedTeams'
        );
    }
}
