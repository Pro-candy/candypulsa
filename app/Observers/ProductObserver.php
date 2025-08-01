<?php

namespace App\Observers;

use App\Models\Product;
use Kreait\Firebase\Factory;

class ProductObserver
{
    protected function firebase()
    {
        return (new Factory)
            ->withServiceAccount(config_path('firebase_credentials.json'))
            ->withDatabaseUri(env('FIREBASE_DB_URL'))
            ->createDatabase();
    }

    public function created(Product $model)
    {
        $this->firebase()->getReference('product/' . $model->id)->set($model->toArray());
    }

    public function updated(Product $model)
    {
        $this->firebase()->getReference('product/' . $model->id)->set($model->toArray());
    }

    public function deleted(Product $model)
    {
        $this->firebase()->getReference('product/' . $model->id)->remove();
    }
}
