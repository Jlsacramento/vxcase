<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendasProduto extends Model
{
    //
    use SoftDeletes;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ven_pro_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ven_id', 'pro_id', 'pro_preco'
    ];

    protected $guarded = ['ven_pro_id', 'created_at', 'update_at'];
}
