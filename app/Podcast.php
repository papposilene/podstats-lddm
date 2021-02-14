<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\LogsActivity;

class Podcast extends Model
{
    use LogsActivity, Searchable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'podcasts';
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
        'name',
        'description',
        'began_on',
        'ended_on',
        'cover'
    ];
    
    /**
     * The attributes that are loggable.
     *
     * @var array
     */
    protected static $logAttributes = [
        'name',
        'description',
        'began_on',
        'ended_on',
        'cover'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'began_on',
        'ended_on',
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
        
    ];
	
	/**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'podcasts';
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
    
    // Override the toArray function (called by toJson)
    public function toArray() {
        $data = parent::toArray();
        $data['link'] = route('public.podcast.show', ['uuid' => $this->uuid]);
        
        if ($this->hasEpisodes) {
            $data['episodes'] = count($this->hasEpisodes);
        } else {
            $data['episodes'] = 0;
        }
        if ($this->hasContacts) {
            $data['contacts'] = count($this->hasContacts);
        } else {
            $data['contacts'] = 0;
        }
        return $data;
    }

    /**
     * Get all the staff for a podcast.
     */
    public function hasContacts()
    {
        return $this->hasManyThrough(
            'App\Contact',
            'App\PodcastHasStaff',
            'contact_uuid',
            'uuid',
            'uuid',
            'podcast_uuid'
        )->orderBy('uname', 'asc');
    }
    
    /**
     * Get all the seasons for a podcast.
     */
    public function hasEpisodes()
    {
        return $this->hasMany(
            'App\Episode',
            'podcast_uuid',
            'uuid'
        )->orderBy('aired_on', 'desc');
    }
    
    /**
     * Get all the links for a podcast.
     */
    public function hasSource()
    {
        return $this->hasOne(
            'App\ItemHasDetail',
            'item_uuid',
            'uuid'
        );
    }

}