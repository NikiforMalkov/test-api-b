<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
 * @package Models
 *
 * @OA\Schema(
 *     title="Item model",
 *     description="Item model",
 * )
 */
class Item extends Model
{
    use HasFactory;

    public $table = 'items';

    public $timestamps = false;

    protected $fillable = [
        'name', 'description', 'category_id'
    ];

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    /**
     * @OA\Property(
     *     format="int64",
     *     description="id",
     *     title="id",
     * )
     *
     * @var integer
     */

     /**
     * @OA\Property(
     *     format="string",
     *     description="name",
     *     title="name",
     * )
     *
     * @var string
     */

    /**
     * @OA\Property(
     *     format="string",
     *     description="description",
     *     title="description",
     * )
     *
     * @var string
     */

    /**
     * @OA\Property(
     *     format="int64",
     *     description="category_id",
     *     title="category_id",
     * )
     *
     * @var integer
     */

}
