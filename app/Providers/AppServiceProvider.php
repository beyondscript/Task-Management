<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(Schema::hasTable('users')){
            if(!User::where('type', 'admin')->exists()){
                User::create([
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'type' => 'admin',
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345678')
                ]);
            }
        }
    }
}
