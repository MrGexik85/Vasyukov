<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Unit extends Model
{
    use HasFactory;

    /**
     * The database's name.
     *
     * @var string
     */
    protected $table = 'unit';
}
