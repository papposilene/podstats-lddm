<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class EpisodeHasTrack extends Model
{
    use LogsActivity, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'episode_has_tracks';
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
        'podcast_uuid',
        'episode_uuid',
        'game_uuid',
        'track_uuid',
        'track_id',
        'track_type',
    ];
    
    /**
     * The attributes that are loggable.
     *
     * @var array
     */
    protected static $logAttributes = [
        'podcast_uuid',
        'episode_uuid',
        'game_uuid',
        'track_uuid',
        'track_id',
        'track_type',
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
        'podcast_uuid' => 'uuid',
        'episode_uuid' => 'uuid',
        'game_uuid' => 'uuid',
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
     * Get all the staff for a podcast.
     */
    public function hasComposers()
    {
        return $this->hasMany(
            'App\ContactHasTrack',
            'track_uuid',
            'track_uuid'
        );
    }
    
    /**
     * Get the episode in which a contact worked.
     */
    public function hasPodcast()
    {
        return $this->hasOne(
            'App\Podcast',
            'uuid',
            'podcast_uuid'
        );
    }

    /**
     * Get the episode in which a contact worked.
     */
    public function hasEpisode()
    {
        return $this->hasOne(
            'App\Episode',
            'uuid',
            'episode_uuid'
        );
    }
    
    /**
     * Get the episode in which a contact worked.
     */
    public function hasGame()
    {
        return $this->hasOne(
            'App\Game',
            'uuid',
            'game_uuid'
        );
    }
    
    /**
     * Get the episode in which a contact worked.
     */
    public function hasTrack()
    {
        return $this->hasOne(
            'App\Track',
            'uuid',
            'track_uuid'
        );
    }
}