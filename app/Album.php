<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Album extends Model
{
    use LogsActivity, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'albums';
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
        'date',
		'mbid',
        'created_by'
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'date',
		'mbid',
        'created_by'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date' => 'date',
		'deleted_at'
	];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_by',
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
		'mbid' => 'uuid',
        'created_by' => 'uuid'
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
     * Get the country where the manufacturer's office is located.
     */
	public function locatedAt()
	{
		return $this->belongsTo(
			'App\Country',
			'country_uuid',
			'uuid'
		);
	}
	
    /**
     * Get the consoles that the manufacturer have produced.
     */
	public function produces()
	{
		return $this->hasMany(
			'App\Game',
			'studio_uuid',
			'uuid'
		);
	}
	
	/**
     * Get the consoles that the manufacturer have produced.
     */
	public function games()
    {
        return $this->hasManyThrough(
            'App\Studio',
            'App\Game',
            'manufacturer_uuid',
            'uuid',
            'uuid',
            'game_uuid'
        );
    }
}