<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\LogsActivity;

class Game extends Model
{
    use LogsActivity, Searchable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'videogames';
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
        'studio_uuid',
        'title',
        'released_on',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'studio_uuid',
        'title',
        'released_on',
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
        'deleted_at',
	];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'uuid',
        'studio_uuid' => 'uuid',
    ];
	
    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'videogames';
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
     * Get the consoles that the manufacturer have produced.
     */
	public function createdBy()
	{
        return $this->belongsTo(
            'App\Studio',
            'studio_uuid',
            'uuid'
        );
	}
    
    /**
     * Get the consoles for the game.
     */
    public function hasConsoles()
    {
        return $this->hasManyThrough(
            'App\Console',
            'App\GameHasConsole',
            'game_uuid',
            'uuid',
            'uuid',
            'console_uuid'
        );
	}
    
    /**
     * Get the games in which a contact worked.
     */
    public function hasGenres()
    {
        return $this->hasManyThrough(
            'App\Genre',
            'App\GameHasGenre',
            'game_uuid',
            'uuid',
            'uuid',
            'genre_uuid'
        );
    }
    
    /**
     * Get the games in which a contact worked.
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
     * Get the serie in which the game is.
     */
    public function hasSerie()
    {
        return $this->hasOne(
            'App\GameHasSerie',
            'game_uuid',
            'uuid'
        );
    }
    
    /**
     * Get the games in which a contact worked.
     */
    public function hasTracklist()
    {
        return $this->hasManyThrough(
            'App\Track',
            'App\EpisodeHasTrack',
            'game_uuid',
            'uuid',
            'uuid',
            'track_uuid'
        )->orderBy('track_id', 'asc');
    }

    /**
     * Get the episodes in which a contact worked.
     */
    public function inEpisodes()
    {
        return $this->hasMany(
            'App\EpisodeHasStaff',
            'game_uuid',
            'uuid'
        );
    }

    /**
     * Get the podcasts in which the game is mentionned.
     */
    public function inPodcasts()
    {
        return $this->hasManyThrough(
            'App\Episode',
            'App\EpisodeHasTrack',
            'game_uuid',
            'uuid',
            'uuid',
            'episode_uuid'
        );
    }
    
    /**
     * Get the games in which a contact worked.
     */
    public function inGames()
    {
        return $this->hasMany(
            'App\GameHasStaff',
            'game_uuid',
            'uuid'
        );
    }
}