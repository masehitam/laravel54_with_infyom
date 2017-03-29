<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version March 29, 2017, 2:51 am UTC
 */
class Product extends Model
{
    use SoftDeletes;

    const BASE_PATH = 'uploads/productImages';

    public $table = 'products';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'category_id',
        'picture'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
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
        'category_id' => 'required|numeric'
    ];

	public function category() {
		return $this->belongsTo('App\Models\Category');
	}
}
