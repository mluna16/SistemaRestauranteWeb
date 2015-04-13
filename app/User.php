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
	protected $fillable = ['first_name','last_name', 'email', 'password','type','img_profile','first_time'];

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
        //Retorna el nombre del restaurante asociado al admin del restaurante
            if(Auth::user()->getIsASystemGod()){
                if(! Auth::user()->getIsAFirstTimeUser())return  Local::where('owner', Auth::user()->id)->take(1)->firstOrFail()->name;
                else return "No";
            }else{
                $ownerID = User::where('id',Auth::user()->id)->firstOrFail()->created_by;
                return Local::where('owner', $ownerID)->take(1)->firstOrFail()->name;
            }
    }

    public function getUserByCretedBy($value){
        //Retorna la informacion de un usuario segun quien lo creo
        return  User::where('created_by',$value)->get();
    }

    public function getUserIDCreator(){
        return User::find(Auth::user()->id)->created_by;
    }

    public function getIsAFirstTimeUser(){
        //Pregunta si el usuario en sesion entro ya al sistema o no
        $return = User::where('id',Auth::user()->id)->firstOrFail()->first_time;
        if($return == true) return true;
        else return false;
    }

    public function getIsASystemGod(){
        //Pregunta si el usuario en sesion es un admin
        if(Auth::user()->type == 'admin') return true;
        else return false;
    }
    public function UpdateFirstTimeUser(){
        $user = User::where('id',Auth::user()->id )->update(['first_time' => false]);
    }

    public function ReturnToFirstTime(){
        return view ('usuarios.firstTime');
    }

    public function UpdatePassword($value){

        User::where('id',Auth::user()->id)->update(['password' => \Hash::make($value)]);
    }
}
