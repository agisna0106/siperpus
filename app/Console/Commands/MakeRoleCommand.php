<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class MakeRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:role {name : Nama role yang ingin dibuat}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat role baru untuk Spatie Permission';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $roleName = $this->argument('name');

        if (Role::where('name', $roleName)->exists()) {
            $this->error("Role '{$roleName}' sudah ada di database!");
            return Command::FAILURE;
        }

        Role::create(['name' => $roleName]);

        $this->info("Berhasil! Role '{$roleName}' telah dibuat.");
        return Command::SUCCESS;
    }
}
