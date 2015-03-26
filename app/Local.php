<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed owner
 */
class Local extends Model {

	protected $table = 'local';

    protected $fillable = ['name','number_tables', 'owner','location','img_local'];

    public function getNameOwnerAttribute(){
       return User::where('id', $this->owner)->firstOrFail()->FullName;
    }




}
