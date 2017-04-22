<?php

namespace App\Models;

use App\Traits\IdTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version March 29, 2017, 2:51 am UTC
 */
class Product extends Model
{
    use SoftDeletes, IdTrait;

    const BASE_PATH = 'uploads/productImages';

    public $table = 'products';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'category_id',
        'picture',
		'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    	'id' => 'string',
        'name' => 'string',
        'picture' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:3|max:35',
        'category_id' => 'required'
    ];

	public function category() {
		return $this->belongsTo('App\Models\Category');
	}
}
