<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class ContactHasTrack extends Model
{
    use LogsActivity, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact_has_tracks';
    protected $primaryKey = 'uuid';
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_uuid',
        'track_uuid',
    ];
    
    /**
     * The attributes that are loggable.
     *
     * @var array
     */
    protected static $logAttributes = [
        'contact_uuid',
        'track_uuid',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
	];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'contact_uuid' => 'uuid',
        'track_uuid' => 'uuid',
    ];
	
	/**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    
    /**
     * Boot the Model.
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
    
    /**
     * Get all the composers for a track.
     */
    public function composedBy()
    {
        return $this->hasOne(
            'App\Contact',
            'uuid',
            'contact_uuid'
        );
    }
    
    /**
     * Get all the track composed by a composer.
     */
    public function hasComposed()
    {
        return $this->hasOne(
            'App\Track',
            'uuid',
            'track_uuid'
        );
    }
    
    /**
     * Get all the track composed by a composer.
     */
    public function inEpisode()
    {
        return $this->hasOne(
            'App\EpisodeHasTrack',
            'track_uuid',
            'track_uuid'
        );
    }
    
    /**
     * Get all the track composed by a composer.
     */
    public function composedFor()
    {
        return $this->hasOneThrough(
            'App\Game',
            'App\EpisodeHasTrack',
            'track_uuid',
            'uuid',
            'track_uuid',
            'game_uuid'
        );
    }
}