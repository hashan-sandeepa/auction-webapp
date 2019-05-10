<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'auction_id', 'user_id', 'amount'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function auction()
    {
        return $this->belongsTo('App\Auction');
    }
}
