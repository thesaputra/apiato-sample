<?php


namespace App\Containers\Traits;

use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Parents\Exceptions\Exception;
use Ramsey\Uuid\Uuid as Generator;


trait Uuid
{

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {

          try {

            $user = auth_user();
            if ($user) {
                $model->created_by = $user->id;
            }

            $model->id = Generator::uuid4()->toString();

          } catch (Exception $exception) {
            throw new InternalErrorException($exception->getMessage());
          }

        });

      static::updating(function($model) {

        try {
          $user = auth_user();
          if ($user) {
              $model->updated_by = $user->id;
          }

        } catch (Exception $exception) {
          throw new InternalErrorException($exception->getMessage());
        }

      });
    }


    public function generateUuid()
    {
      return Generator::uuid4()->toString();
    }
}
