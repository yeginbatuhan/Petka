<?php
namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;

trait Multitenantable {
  public static function bootMultitenantable() {

    if (auth()->check()) {

      if (auth()->user()->user_type!=0)
      {
      static::creating(function ($model) {
        $model->user_id = auth()->user()->id;
      });

      static::addGlobalScope('user_id', function (Builder $builder) {
        if (auth()->check()) {
          return $builder->whereUserId(auth()->user()->id);
        }
      });
      }
    }
  }
}
