<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class PromoteAdmin extends Command
{
    protected $signature = 'user:promote-admin {email}';
    protected $description = 'Promover um usuário a administrador';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error('Usuário não encontrado.');
            return;
        }

        $user->role = 'admin';
        $user->save();

        $this->info('Usuário promovido a administrador com sucesso.');
    }
}
