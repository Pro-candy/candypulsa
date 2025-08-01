<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\FirebaseHelper;

class FirebaseSyncObserver
{
    protected function getTableName(Model $model)
    {
        return $model->getTable();
    }

    protected function getKey(Model $model)
    {
        return $model->getKey();
    }

    protected function getData(Model $model)
    {
        return $model->toArray();
    }

    public function created(Model $model)
    {
        $table = $this->getTableName($model);
        $key = $this->getKey($model);
        FirebaseHelper::database()->getReference("{$table}/{$key}")->set($this->getData($model));
    }

    public function updated(Model $model)
    {
        $table = $this->getTableName($model);
        $key = $this->getKey($model);
        FirebaseHelper::database()->getReference("{$table}/{$key}")->update($this->getData($model));
    }

    public function deleted(Model $model)
    {
        $table = $this->getTableName($model);
        $key = $this->getKey($model);
        FirebaseHelper::database()->getReference("{$table}/{$key}")->remove();
    }
}
