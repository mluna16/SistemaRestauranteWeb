<?php namespace SistemaRestauranteWeb;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name','last_name', 'email', 'password','type','img_profile'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function setPasswordAttribuite($value){

         if( ! empty($value)){
                      $this->attributes['password'] = \Hash::make($value);
         }

  }
    public function Local() {
        return $this->hasOne('SistemaRestauranteWeb\Local');
    }

    public function Product() {
        return $this->hasMany('SistemaRestauranteWeb\Product');
    }

    public function getLocalNameAttribute(){
        if(Auth::user()->type == 'admin'){
            return Local::where('owner', Auth::user()->id)->take(1)->firstOrFail()->name;
        }else{
            $ownerID = User::where('id',Auth::user()->id)->firstOrFail()->created_by;

            return Local::where('owner', $ownerID)->take(1)->firstOrFail()->name;
        }
    }

    public function getUserByCretedBy($value){
        return  User::where('created_by',$value)->get();
    }
}
