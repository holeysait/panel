<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationCampaign extends Model
{
    protected $fillable = ['name','channel','subject','body','status','scheduled_at','filters','meta'];
    protected $casts = ['scheduled_at'=>'datetime','meta'=>'array'];

    public function deliveries()
    {
        return $this->hasMany(NotificationDelivery::class, 'campaign_id');
    }
}
