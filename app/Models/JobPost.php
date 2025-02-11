<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'experience', 'salary', 'location', 'extra_info', 'company_name','logo'];

    protected $appends = ['logo_url','time_ago'];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_post_skill');
    }


    //implement the attribute
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }


    public function getTimeAgoAttribute()
    {
        $createdAt = Carbon::parse($this->attributes['created_at']);
        $now = Carbon::now();
        $diffInSeconds = $createdAt->diffInSeconds($now);

        if ($diffInSeconds < 60) {
            return 'less then '.round($diffInSeconds) . ' sec';
        } elseif ($diffInSeconds < 3600) {
            return 'less then ' . round(floor($diffInSeconds / 60)) . ' min';
        } elseif ($diffInSeconds < 86400) {
            return floor($diffInSeconds / 3600) . ' hour';
        } elseif ($diffInSeconds < 604800) {
            return floor($diffInSeconds / 86400) . ' day';
        } elseif ($diffInSeconds < 2628000) {
            return floor($diffInSeconds / 604800) . ' week';
        } elseif ($diffInSeconds < 31536000) {
            return floor($diffInSeconds / 2628000) . ' month';
        } else {
            return floor($diffInSeconds / 31536000) . ' year';
        }
    }



}
