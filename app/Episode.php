<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\LogsActivity;

class Episode extends Model
{
    use LogsActivity, Searchable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'episodes';
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
        'podcast_uuid',
        'season',
        'id',
        'title',
        'duration',
        'aired_on',
        'description',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'podcast_uuid',
        'season',
        'id',
        'title',
        'duration',
        'aired_on',
        'description',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'aired_on',
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
        'podcast_uuid'  => 'uuid',
        'duration'      => 'datetime:"H:i:s"',
    ];
	
	/**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'episodes';
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
     * Get the podcast's information for an episode.
     */
    public function inPodcast()
    {
        return $this->belongsTo(
            'App\Podcast',
            'podcast_uuid',
            'uuid'
        );
    }
    
    /**
     * Get the official site associated with the episode.
     */
    public function hasSource()
    {
        return $this->hasOne(
            'App\ItemHasDetail',
            'item_uuid',
            'uuid'
        );
    }
    
    /**
     * Get the staff for the episode.
     */
	public function hasContacts()
	{
        return $this->hasMany(
            'App\EpisodeHasStaff',
            'episode_uuid',
            'uuid'
        );
	}
    
    /**
     * Get the tracklist for the episode.
     */
    public function hasTracklist()
    {
        return $this->hasMany(
            'App\EpisodeHasTrack',
            'episode_uuid',
            'uuid'
        )->orderBy('track_id', 'asc');
    }
}