<?php

namespace App\Helpers;

use Kreait\Firebase\Factory;

class FirebaseHelper
{
    public static function database()
    {
        return (new Factory)
            ->withServiceAccount(config_path('firebase_credentials.json'))
            ->withDatabaseUri(env('FIREBASE_DB_URL'))
            ->createDatabase();
    }
}
