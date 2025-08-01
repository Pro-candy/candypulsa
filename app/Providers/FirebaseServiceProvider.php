<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Database;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Database::class, function ($app) {
            $firebase = (new Factory)
                ->withServiceAccount(config_path('firebase_credentials.json'))
                ->withDatabaseUri(env('FIREBASE_DB_URL'));

            return $firebase->createDatabase();
        });
    }

    public function boot()
    {
        //
    }
}
