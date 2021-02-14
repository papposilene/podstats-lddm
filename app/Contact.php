<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\LogsActivity;

class Contact extends Model
{
    use LogsActivity, Searchable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contacts';
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
        'uname',
        'gender',
        'fname',
        'mname',
        'lname',
        'lives_at',
        'born_on',
        'born_at',
        'died_on',
        'died_at',
        'biography',
    ];
    
    /**
     * The attributes that are loggable.
     *
     * @var array
     */
    protected static $logAttributes = [
        'uname',
        'gender',
        'fname',
        'mname',
        'lname',
        'lives_at',
        'born_on',
        'born_at',
        'died_on',
        'died_at',
        'biography',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'born_on',
        'died_on',
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
        'lives_at' => 'uuid',
        'born_at' => 'uuid',
        'died_at' => 'uuid',
    ];
	
	/**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'contacts';
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
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();
        
        $array['country'] = null;
        if ($this->livesAt)
        {
            $array['country-lives-cca2'] = $this->livesAt->cca2;
            $array['country-lives-cca3'] = $this->livesAt->cca3;
            $array['country-lives-name-common'] = $this->livesAt->name_eng_common;
            $array['country-lives-name-official'] = $this->livesAt->name_eng_official;
        }
        if ($this->bornAt)
        {
            $array['country-birth-cca2'] = $this->bornAt->cca2;
            $array['country-birth-cca3'] = $this->bornAt->cca3;
            $array['country-birth-name-common'] = $this->bornAt->name_eng_common;
            $array['country-birth-name-official'] = $this->bornAt->name_eng_official;
        }
        if ($this->diedAt)
        {
            $array['country-death-cca2'] = $this->diedAt->cca2;
            $array['country-death-cca3'] = $this->diedAt->cca3;
            $array['country-death-name-common'] = $this->diedAt->name_eng_common;
            $array['country-death-name-official'] = $this->diedAt->name_eng_official;
        }

        return $array;
    }
    
    // Override the toArray function (called by toJson)
    public function toArray() {
        $data = parent::toArray();
        
        if ($this->livesAt) {
            $latlng = json_decode($data['country']['lat'] = $this->livesAt->latlng, true);
            $data['country']['country_uuid'] = $this->livesAt->uuid;
            $data['country']['region'] = $this->livesAt->region;
            $data['country']['subregion'] = $this->livesAt->subregion;
            $data['country']['cca2'] = $this->livesAt->cca2;
            $data['country']['cca3'] = $this->livesAt->cca3;
            $data['country']['flag'] = $this->livesAt->flag;
            $data['country']['name_common'] = $this->livesAt->name_eng_common;
            $data['country']['name_official'] = $this->livesAt->name_eng_official;
            $data['country']['lat'] = $latlng['lat'];
            $data['country']['lng'] = $latlng['lng'];
        } else {
            $data['country'] = null;
        }
        
        if ($this->hasLinks) {
            $data['sources'] = count($this->hasLinks);
        } else {
            $data['sources'] = 0;
        }
        
        if ($this->hasEpisodes) {
            $data['episodes'] = count($this->hasEpisodes);
        } else {
            $data['episodes'] = 0;
        }
        
        if ($this->hasGames) {
            $data['games'] = count($this->hasGames);
        } else {
            $data['games'] = 0;
        }
        
        if ($this->hasTracks) {
            $data['tracks'] = count($this->hasTracks);
        } else {
            $data['tracks'] = 0;
        }

        return $data;
    }
    
    /**
     * Get the place of birth associated with the contact.
     */
    public function bornAt()
    {
        return $this->hasOne(
            'App\Country',
            'uuid',
            'born_at'
        );
    }
    
    /**
     * Get the place of work associated with the contact.
     */
    public function livesAt()
    {
        return $this->hasOne(
            'App\Country',
            'uuid',
            'lives_at'
        );
    }
    
    /**
     * Get the place of death associated with the contact.
     */
    public function diedAt()
    {
        return $this->hasOne(
            'App\Country',
            'uuid',
            'died_at'
        );
    }
    
    /**
     * Get the episodes in which a contact worked.
     */
    public function hasEpisodes()
    {
        return $this->hasMany(
            'App\EpisodeHasStaff',
            'contact_uuid',
            'uuid'
        )->orderBy('created_at', 'desc');
    }
    
    /**
     * Get the games in which a contact worked.
     */
    public function hasGames()
    {
        return $this->hasMany(
            'App\GameHasStaff',
            'contact_uuid',
            'uuid'
        )->orderBy('created_at', 'desc');
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
     * Get the tracks in which a contact worked.
     */
    public function hasTracks()
    {
        return $this->hasMany(
            'App\ContactHasTrack',
            'contact_uuid',
            'uuid'
        )->orderBy('created_at', 'desc');
    }
    
}