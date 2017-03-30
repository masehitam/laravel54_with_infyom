<?php

namespace App\Models;

use App\Traits\IdTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 * @version March 29, 2017, 2:45 am UTC
 */
class Category extends Model
{
    use SoftDeletes, IdTrait;

    public $table = 'categories';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:3|max:35'
    ];

	public function products() {
		return $this->hasMany('App\Models\Product');
	}
}
