<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'metas';

    //protected $fillable = ['key', 'label', 'type'];


    public function setUpdatedAtAttribute($value)
	{
	    // to Disable updated_at
	}

	public function setCreatedAtAttribute($value)
	{
	    // to Disable updated_at
	}
	
    public function user()
    {
    	return $this->belongsToMany('App\Models\User','meta_user','meta_id','user_id');
    }



}
