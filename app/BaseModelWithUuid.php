<?php

namespace App;

use Ramsey\Uuid\Uuid;

class BaseModelWithUuid extends BaseModel
{
    /**
     * Setup model event hooks
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function(self $model) {
            // Generate a value for the UUID column, as defined in uuidColumn( ),
            // just before a new instance is saved to the database.
            $model->uuid = (string) Uuid::uuid4()->toString();
        } );
    }
}
