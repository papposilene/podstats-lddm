<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->group(function () {
    // Consoles
    Route::get('consoles/autocomplete', 'API\ConsoleController@autocomplete')->name('api.console.autocomplete');
    Route::get('consoles/json', 'API\ConsoleController@json')->name('api.console.json');
    Route::get('consoles/data/consoles', 'API\ConsoleController@consoles')->name('api.console.consoles');
    Route::get('consoles/data/genres/{uuid?}', 'API\ConsoleController@genres')->name('api.console.genres');
    Route::get('consoles/data/types/{uuid?}', 'API\ConsoleController@types')->name('api.console.types');
    
    // Contacts
    Route::get('contacts/autocomplete', 'API\ContactController@autocomplete')->name('api.contact.autocomplete');
    Route::get('contacts/data/consoles/{uuid}', 'API\ContactController@consoles')->name('api.contact.consoles');
    Route::get('contacts/data/countries/{cca3?}', 'API\ContactController@countries')->name('api.contact.countries');
    Route::get('contacts/data/genders', 'API\ContactController@genders')->name('api.contact.genders');
    Route::get('contacts/data/genres/{uuid}', 'API\ContactController@genres')->name('api.contact.genres');
    Route::get('contacts/data/studios/{uuid}', 'API\ContactController@studios')->name('api.contact.studios');
    
    // Countries
    Route::get('countries/autocomplete', 'API\CountryController@autocomplete')->name('api.country.autocomplete');
    Route::get('countries/json', 'API\CountryController@json')->name('api.country.json');
    
    // Episodes
    Route::get('episodes/data/continents/{eid?}', 'API\EpisodeController@continents')->where('eid', '[0-9]+')->name('api.episode.continents');
    Route::get('episodes/data/genders/{eid?}', 'API\EpisodeController@genders')->where('eid', '[0-9]+')->name('api.episode.genders');
    Route::get('episodes/data/genres/{eid}', 'API\EpisodeController@genres')->where('eid', '[0-9]+')->name('api.episode.genres');
    Route::get('episodes/data/months/{eid?}', 'API\EpisodeController@months')->where('eid', '[0-9]+')->name('api.episode.months');
    
    // Games
    Route::get('games/autocomplete', 'API\GameController@autocomplete')->name('api.game.autocomplete');
    Route::get('games/data/genres/{uuid?}', 'API\GameController@genres')->name('api.game.genres');
    Route::get('games/data/modes/{uuid?}', 'API\GameController@modes')->name('api.game.modes');
    
    // Genres
    Route::get('genres/data/modes/{uuid}', 'API\GenreController@modes')->name('api.genre.modes');
    Route::get('genres/data/continents/{uuid}', 'API\GenreController@continents')->name('api.genre.continents');
    
    // Manufacturers
    Route::get('manufacturers/autocomplete', 'API\ManufacturerController@autocomplete')->name('api.manufacturer.autocomplete');
    Route::get('manufacturers/json', 'API\ManufacturerController@json')->name('api.manufacturer.json');
    Route::get('manufacturers/geojson', 'API\ManufacturerController@geojson')->name('api.manufacturer.geojson');
    Route::get('manufacturers/data/consoles/{uuid?}', 'API\ManufacturerController@consoles')->name('api.manufacturer.consoles');
    Route::get('manufacturers/data/continents', 'API\ManufacturerController@continents')->name('api.manufacturer.continents');
    
    // Podcasts
    Route::get('podcasts/autocomplete', 'API\PodcastController@autocomplete')->name('api.podcast.autocomplete');
    Route::get('podcasts/json', 'API\PodcastController@json')->name('api.podcast.json');
    
    // Professions
    Route::get('professions/autocomplete', 'API\ProfessionController@autocomplete')->name('api.profession.autocomplete');
    
    // Seasons
    Route::get('seasons/data/stats/{season}', 'API\SeasonController@stats')->where('season', '[0-9]+')->name('api.seasons.stats');
    Route::get('seasons/data/months/{season}', 'API\SeasonController@months')->where('season', '[0-9]+')->name('api.seasons.months');
    
    // Series
    Route::get('series/autocomplete', 'API\SerieController@autocomplete')->name('api.serie.autocomplete');
    
    // Studios
    Route::get('studios/autocomplete', 'API\StudioController@autocomplete')->name('api.studio.autocomplete');
    Route::get('studios/geojson', 'API\StudioController@geojson')->name('api.studio.geojson');
    Route::get('studios/data/continents', 'API\StudioController@continents')->name('api.studio.continents');
    Route::get('studios/data/genres/{uuid?}', 'API\StudioController@genres')->name('api.studio.genres');
    Route::get('studios/data/modes/{uuid?}', 'API\StudioController@modes')->name('api.studio.modes');
});