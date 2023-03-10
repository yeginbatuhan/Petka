<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'created_at',
        'updated_at',
        'email_verified_at',
        'current_team_id',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

  public function get_user()
  {
    $user_data = User::all();

    return ['message' => 'Bilgileriniz', 'status' => true, 'data' => $user_data];

  }
  public function user_update_api($data,$user)
  {
    if ($data->has('password'))
    {
      $data=$data->all();
      $data['password']=Hash::make($data['password']);
      $user->update($data);
    }else{
      $data=$data->all();
      $user->update($data);
    }

    return ['message' => 'Bilgileriniz Başarıyla Güncellenmiştir', 'status' => true, 'data' => $user,];
  }

public function permits()
{
  return $this->hasMany(Permit::class);
}

}
