<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package Models
 *
 * @OA\Schema(
 *     title="Category model",
 *     description="Category model",
 * )
 */
class Category extends Model
{
    use HasFactory;

    public $table = 'categories';

    public $timestamps = false;

    protected $fillable = [
        'name', 'parent_id', 'index'
    ];

    /**
     * @OA\Property(
     *     format="int64",
     *     description="id",
     *     title="id",
     * )
     *
     * @var integer
     */
    protected $id;

     /**
     * @OA\Property(
     *     format="string",
     *     description="name",
     *     title="name",
     * )
     *
     * @var string
     */
    protected $name;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="parent_id",
     *     title="parent_id",
     * )
     *
     * @var integer
     */
    protected $parent_id;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="index",
     *     title="index",
     * )
     *
     * @var integer
     */
    protected $index;

}
