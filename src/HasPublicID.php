<?php

namespace Crnkovic\PublicID;

trait HasPublicID
{
    /**
     * Boots the trait. Sets up Model Observers for "creating" and "saving" events.
     * If the model is persisted to the database, table column (specified in configuration) is set to the generated public ID.
     * If the user tries to manually change the value, original value won't be overriden.
     * 
     * @return void
     */
    public static function bootHasPublicID()
    {
        $key = config('public-id.key', 'public_id');

        // Specifying "creating" event
        static::creating(function ($model) use ($key) {
            $model->{$key} = PublicID::generate();
        });

        // Specifying "saving" event
        static::saving(function ($model) use ($key) {
            $original = $model->getOriginal($key);

            // Key can't be different than original one
            if ($original != $model->{$key}) {
                $model->{$key} = $original;
            }
        });
    }
}