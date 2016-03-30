<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed owner
 */


/**
 * Metodos de este Modelo
 *         getNameOwnerAttribute() -> retorna el nombre del Due#o del Restaurante
 *         getMesasAttribute() -> Retorna el numero de mesas del restaurante en sesion
 *         Product() -> relacion entre los modelos Producto y Local
 *         User-> Relacion uno a uno del Local con el Usuario
 *         getLocalIdAttribute() -> Retorna el id de un Local en sesion
 *         setOwnerAttribute-> Cambia el valor del Owner antes de crearlo en la base de Datos
 *         getLocalForOwner()-> Retorna la informacion del restaurante para los usuarios Admin
 *         getLocalForUser()->
 *
 *
 *
 */
class Local extends Model {

	protected $table = 'local';

    protected $fillable = array('name','location','number_tables','owner','rif');

    public function getNameOwnerAttribute(){
       return User::where('id', $this->owner)->firstOrFail()->FullName;
    }

    public function  getMesasAttribute(){
        $ownerID = User::where('id',Auth::user()->id)->firstOrFail()->created_by;
        $mesas = Local::where('owner',$ownerID)->firstOrFail()->number_tables;
        return $mesas;
    }
    public function Product() {
        return $this->hasOne('SistemaRestauranteWeb\Product');
    }

    public function User() {
        return $this->hasOne('SistemaRestauranteWeb\User');
    }

    public function getLocalIdAttribute(){
        $user = new User();
            if (Auth::user()->getIsASystemGod()) {
                if(! $user->getIsAFirstTimeUser()) return Local::where('owner', Auth::user()->id)->take(1)->firstOrFail()->id;
                else return 000;
            } else {
                $ownerID = User::where('id', Auth::user()->id)->firstOrFail()->created_by;

                return Local::where('owner', $ownerID)->take(1)->firstOrFail()->id;
            }
    }

    public function setOwnerAttribute($value){

        $this->attributes['owner'] = Auth::user()->id;
    }

    public function getLocalForOwner(){
        /** @var json $return */
        return  Local::where('owner', Auth::user()->id)->get();
    }

    public function  getLocalForUser(){
        $user = new User();
        return Local::where('owner',$user->getUserIDCreator())->get();
    }

    public  function getAllLocalInformationByUser($id){
        $user = new User();
        $local = Local::where('owner',$id)->firstOrFail();
        $localImage = LocalImage::where('id_local',$local->id)->firstOrFail();

        $localAllInfo[] = [

            'id_local' => $local->id,
            'name' => $local->name,
            'location' => $local->location,
            'number_tables' => $local->number_tables,
            'owner' => $user->getFullNameUserById($local->owner),
            'id_image' => $localImage->id,
            'rif'       => $local->rif,
            'image' => $localImage->name.".".$localImage->type
        ];

        return Collection::make($localAllInfo);
    }

    public function NumberTable(){
        $local = new local();
        $locals = Local::find($local->getLocalIdAttribute());
        return $locals->number_tables;
    }

    public function getLocalNameForUser()
    {
        $user = new User();
        if (Auth::user()->getIsASystemGod()) {
            if(! $user->getIsAFirstTimeUser()) return Local::where('owner', Auth::user()->id)->take(1)->firstOrFail()->name;
            else return 000;
        } else {
            $ownerID = User::where('id', Auth::user()->id)->firstOrFail()->created_by;

            return Local::where('owner', $ownerID)->take(1)->firstOrFail()->name;
        }
    }

    public function getLocalRif()
    {
        $user = new User();
        if (Auth::user()->getIsASystemGod()) {
            if(! $user->getIsAFirstTimeUser()) return Local::where('owner', Auth::user()->id)->take(1)->firstOrFail()->id;
            else return 000;
        } else {
            $ownerID = User::where('id', Auth::user()->id)->firstOrFail()->created_by;

            return Local::where('owner', $ownerID)->take(1)->firstOrFail()->rif;
        }
    }

    public function getLocalLocation()
    {
        $user = new User();
        if (Auth::user()->getIsASystemGod()) {
            if(! $user->getIsAFirstTimeUser()) return Local::where('owner', Auth::user()->id)->take(1)->firstOrFail()->id;
            else return 000;
        } else {
            $ownerID = User::where('id', Auth::user()->id)->firstOrFail()->created_by;

            return Local::where('owner', $ownerID)->take(1)->firstOrFail()->location;
        }
    }
}

