<?php

namespace CryptaEve\Seat\MoonBot\Models;

use Illuminate\Database\Eloquent\Model;
use Seat\Eveapi\Models\Corporation\CorporationInfo;

class Api extends Model
{
    public $timestamps = true;

    protected $table = 'crypta_seat_moonbot_api';

    public function corporations()
    {
        return $this->hasManyThrough(
            CorporationInfo::class,
            CorpPivot::class,
            'api_id',
            'corporation_id',
            'id',
            'corp_id'
        );
    }

}
