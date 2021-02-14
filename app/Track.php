<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\LogsActivity;

class Track extends Model
{
    use LogsActivity, Searchable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tracks';
    protected $primaryKey = 'uuid';
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * The attributes that are loggable.
     *
     * @var array
     */
    protected static $logAttributes = [
        'title',
        'released_on',
        'duration',
        'mbid'
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'released_on',
        'duration',
        'mbid'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'released_on',
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
        'uuid' => 'uuid',
        'duration' => 'datetime:"H:i:s"',
        'mbid' => 'uuid',
    ];
	
	/**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'tracks';
    }
	
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
     * Get the artist's information for a track.
     */
    public function hasArtists()
    {
        return $this->hasMany(
            'App\ContactHasTrack',
            'track_uuid',
            'uuid'
        );
    }
    
    /**
     * Get the games in which a contact worked.
     */
    public function hasGame()
    {
        return $this->hasOneThrough(
            'App\Game',
            'App\EpisodeHasTrack',
            'track_uuid',
            'uuid',
            'uuid',
            'game_uuid'
        );
    }

    /**
     * Get the sources of a track.
     */
    public function hasLinks()
    {
        return $this->hasMany(
            'App\ItemHasDetail',
            'item_uuid',
            'uuid'
        )->orderBy('type', 'asc');
    }
    
    /**
     * Get the game associated with the track.
     */
    public function inEpisodes()
    {
        return $this->hasMany(
            'App\EpisodeHasTrack',
            'track_uuid',
            'uuid'
        );
    }
}