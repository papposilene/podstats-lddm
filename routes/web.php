<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    // ./admin
    Route::get('admin','Admin\AdminController@index')->name('admin.index');
	Route::post('admin/search','Admin\SearchController@internal')->name('admin.search.index');
    Route::get('admin/activity','Admin\AdminController@activity')->name('admin.activity.index');
	
    // ./admin/user
    Route::get('admin/user','Admin\UserController@index')->name('admin.user.index');
    Route::get('admin/user/invite','Admin\UserController@invite')->name('admin.invite.index');
    Route::post('admin/user/process','Admin\UserController@process')->name('admin.invite.process');
    Route::get('admin/user/accept/{token}','Admin\UserController@accept')->name('admin.invite.accept');
    Route::post('admin/user/register', 'Auth\RegisterController@register')->name('admin.invite.register');
    Route::get('admin/user/show/{uuid?}','Admin\UserController@show')->name('admin.user.show');
    Route::post('admin/user/update','Admin\UserController@update')->name('admin.user.update');
    Route::post('admin/user/permission','Admin\UserController@permission')->name('admin.user.permission');
    
    // ./admin/staff
    Route::get('admin/profession','Admin\ProfessionController@index')->name('admin.profession.index');
    Route::post('admin/profession/store','Admin\ProfessionController@store')->name('admin.profession.store');
    Route::get('admin/profession/show/{uuid}','Admin\ProfessionController@show')->name('admin.profession.show');
    Route::post('admin/profession/delete','Admin\ProfessionController@delete')->name('admin.profession.delete');
    Route::get('admin/profession/restore/{uuid}','Admin\ProfessionController@restore')->name('admin.profession.restore');
    Route::get('admin/profession/destroy/{uuid}','Admin\ProfessionController@destroy')->name('admin.profession.destroy');

    Route::post('admin/staff','Admin\ProfessionController@staff')->name('admin.staff');
    Route::post('admin/unstaff','Admin\ProfessionController@unstaff')->name('admin.unstaff');
    
    Route::post('admin/link/contact','Admin\RelationController@createEpisode')->name('admin.link.episode');
    Route::post('admin/link/game','Admin\RelationController@createGame')->name('admin.link.game');
    Route::post('admin/link/track','Admin\RelationController@createTrack')->name('admin.link.track');
    Route::post('admin/unlink/staff','Admin\RelationController@deleteEpisode')->name('admin.unlink.episode');
    Route::post('admin/unlink/game','Admin\RelationController@deleteGame')->name('admin.unlink.game');
    Route::post('admin/unlink/track','Admin\RelationController@deleteTrack')->name('admin.unlink.track');

    // ./admin/contact
    Route::get('admin/contact','Admin\ContactController@index')->name('admin.contact.index');
    Route::post('admin/contact','Admin\ContactController@index')->name('admin.contact.search');
    Route::get('admin/contact/new','Admin\ContactController@create')->name('admin.contact.create');
    Route::post('admin/contact/store','Admin\ContactController@store')->name('admin.contact.store');
    Route::get('admin/contact/edit/{uuid}','Admin\ContactController@edit')->name('admin.contact.edit');
    Route::post('admin/contact/update','Admin\ContactController@update')->name('admin.contact.update');
    Route::post('admin/staff/store','Admin\ContactController@staff')->name('admin.contact.staff');
    Route::get('admin/contact/show/{uuid}','Admin\ContactController@show')->name('admin.contact.show');
    Route::post('admin/contact/delete','Admin\ContactController@delete')->name('admin.contact.delete');
    Route::get('admin/contact/restore/{uuid}','Admin\ContactController@restore')->name('admin.contact.restore');
    Route::get('admin/contact/destroy/{uuid}','Admin\ContactController@destroy')->name('admin.contact.destroy');
    
    // ./admin/podcast
    Route::get('admin/podcast','Admin\PodcastController@index')->name('admin.podcast.index');
    Route::post('admin/podcast','Admin\PodcastController@index')->name('admin.podcast.search');
    Route::post('admin/podcast/store','Admin\PodcastController@store')->name('admin.podcast.store');
    Route::get('admin/podcast/show/{uuid}','Admin\PodcastController@show')->name('admin.podcast.show');
    Route::get('admin/podcast/edit/{uuid?}','Admin\PodcastController@edit')->name('admin.podcast.edit');
    Route::post('admin/podcast/update','Admin\PodcastController@update')->name('admin.podcast.update');
    Route::post('admin/podcast/detail','Admin\PodcastController@detail')->name('admin.podcast.detail');
    Route::post('admin/podcast/delete','Admin\PodcastController@delete')->name('admin.podcast.delete');
    Route::get('admin/podcast/restore/{uuid}','Admin\PodcastController@restore')->name('admin.podcast.restore');
    Route::get('admin/podcast/destroy/{uuid}','Admin\PodcastController@destroy')->name('admin.podcast.destroy');
    
    // ./admin/episode
    Route::get('admin/episode','Admin\EpisodeController@index')->name('admin.episode.index');
    Route::post('admin/episode','Admin\EpisodeController@index')->name('admin.episode.search');
    Route::post('admin/episode/store','Admin\EpisodeController@store')->name('admin.episode.store');
    Route::get('admin/episode/show/{uuid}','Admin\EpisodeController@show')->name('admin.episode.show');
    Route::post('admin/episode/import','Admin\EpisodeController@import')->name('admin.episode.import');
    Route::get('admin/episode/edit/{uuid?}','Admin\EpisodeController@edit')->name('admin.episode.edit');
    Route::post('admin/episode/update','Admin\EpisodeController@update')->name('admin.episode.update');
    Route::post('admin/episode/delete','Admin\EpisodeController@delete')->name('admin.episode.delete');
    Route::get('admin/episode/restore/{uuid}','Admin\EpisodeController@restore')->name('admin.episode.restore');
    Route::get('admin/episode/destroy/{uuid}','Admin\EpisodeController@destroy')->name('admin.episode.destroy');
    
    // ./admin/source
    Route::get('admin/source','Admin\SourceController@index')->name('admin.source.index');
    Route::post('admin/source','Admin\SourceController@index')->name('admin.source.search');
    Route::post('admin/source/store','Admin\SourceController@store')->name('admin.source.store');
    Route::post('admin/source/type','Admin\SourceController@storeType')->name('admin.source.type');
    Route::get('admin/source/edit/{uuid}','Admin\SourceController@edit')->name('admin.source.edit');
    Route::post('admin/source/update','Admin\SourceController@update')->name('admin.source.update');
    Route::post('admin/source/delete','Admin\SourceController@delete')->name('admin.source.delete');
    Route::get('admin/source/restore/{uuid}','Admin\SourceController@restore')->name('admin.source.restore');
    Route::get('admin/source/destroy/{uuid}','Admin\SourceController@destroy')->name('admin.source.destroy');
    
    // ./admin/track
    Route::get('admin/track','Admin\TrackController@index')->name('admin.track.index');
    Route::post('admin/track','Admin\TrackController@index')->name('admin.track.search');
    Route::post('admin/track/store','Admin\TrackController@store')->name('admin.track.store');
    Route::get('admin/track/show/{uuid}','Admin\TrackController@show')->name('admin.track.show');
    Route::post('admin/track/import','Admin\TrackController@import')->name('admin.track.import');
    Route::get('admin/track/edit/{uuid?}','Admin\TrackController@edit')->name('admin.track.edit');
    Route::post('admin/track/update','Admin\TrackController@update')->name('admin.track.update');
    Route::post('admin/track/delete','Admin\TrackController@delete')->name('admin.track.delete');
    Route::get('admin/track/restore/{uuid}','Admin\TrackController@restore')->name('admin.track.restore');
    Route::get('admin/track/destroy/{uuid}','Admin\TrackController@destroy')->name('admin.track.destroy');
	
    // ./admin/manufacturer, console, studio & game
    Route::get('admin/manufacturer','Admin\ManufacturerController@index')->name('admin.manufacturer.index');
    Route::post('admin/manufacturer','Admin\ManufacturerController@index')->name('admin.manufacturer.search');
    Route::post('admin/manufacturer/store','Admin\ManufacturerController@store')->name('admin.manufacturer.store');
    Route::get('admin/manufacturer/show/{uuid}','Admin\ManufacturerController@show')->name('admin.manufacturer.show');
    Route::get('admin/manufacturer/edit/{uuid}','Admin\ManufacturerController@edit')->name('admin.manufacturer.edit');
    Route::post('admin/manufacturer/update','Admin\ManufacturerController@update')->name('admin.manufacturer.update');
    Route::post('admin/manufacturer/delete','Admin\ManufacturerController@delete')->name('admin.manufacturer.delete');
    Route::get('admin/manufacturer/restore/{uuid}','Admin\ManufacturerController@restore')->name('admin.manufacturer.restore');
    Route::get('admin/manufacturer/destroy/{uuid}','Admin\ManufacturerController@destroy')->name('admin.manufacturer.destroy');
	
    Route::get('admin/console','Admin\ConsoleController@index')->name('admin.console.index');
    Route::post('admin/console','Admin\ConsoleController@index')->name('admin.console.search');
    Route::post('admin/console/store','Admin\ConsoleController@store')->name('admin.console.store');
    Route::get('admin/console/show/{uuid}','Admin\ConsoleController@show')->name('admin.console.show');
    Route::get('admin/console/edit/{uuid}','Admin\ConsoleController@edit')->name('admin.console.edit');
    Route::post('admin/console/update','Admin\ConsoleController@update')->name('admin.console.update');
    Route::post('admin/console/delete','Admin\ConsoleController@delete')->name('admin.console.delete');
    Route::get('admin/console/restore/{uuid}','Admin\ConsoleController@restore')->name('admin.console.restore');
    Route::get('admin/console/destroy/{uuid}','Admin\ConsoleController@destroy')->name('admin.console.destroy');
    
    Route::get('admin/studio','Admin\StudioController@index')->name('admin.studio.index');
    Route::post('admin/studio','Admin\StudioController@index')->name('admin.studio.search');
    Route::post('admin/studio/store','Admin\StudioController@store')->name('admin.studio.store');
    Route::get('admin/studio/show/{uuid}','Admin\StudioController@show')->name('admin.studio.show');
    Route::get('admin/studio/edit/{uuid}','Admin\StudioController@edit')->name('admin.studio.edit');
    Route::post('admin/studio/update','Admin\StudioController@update')->name('admin.studio.update');
    Route::post('admin/studio/delete','Admin\StudioController@delete')->name('admin.studio.delete');
    Route::get('admin/studio/restore/{uuid}','Admin\StudioController@restore')->name('admin.studio.restore');
    Route::get('admin/studio/destroy/{uuid}','Admin\StudioController@destroy')->name('admin.studio.destroy');
    
    Route::get('admin/genre','Admin\GenreController@index')->name('admin.genre.index');
    Route::post('admin/genre','Admin\GenreController@index')->name('admin.genre.search');
    Route::get('admin/genre/create','Admin\GenreController@create')->name('admin.genre.create');
    Route::post('admin/genre/store','Admin\GenreController@store')->name('admin.genre.store');
    Route::get('admin/genre/show/{uuid}','Admin\GenreController@show')->name('admin.genre.show');
    Route::post('admin/genre/update','Admin\GenreController@update')->name('admin.genre.update');
    Route::post('admin/genre/delete','Admin\GenreController@delete')->name('admin.genre.delete');
    Route::get('admin/genre/restore/{uuid}','Admin\GenreController@restore')->name('admin.genre.restore');
    Route::get('admin/genre/destroy/{uuid}','Admin\GenreController@destroy')->name('admin.genre.destroy');
	
    Route::get('admin/game','Admin\GameController@index')->name('admin.game.index');
    Route::post('admin/game','Admin\GameController@index')->name('admin.game.search');
    Route::get('admin/game/create','Admin\GameController@create')->name('admin.game.create');
    Route::post('admin/game/store','Admin\GameController@store')->name('admin.game.store');
    Route::get('admin/game/show/{uuid}','Admin\GameController@show')->name('admin.game.show');
    Route::get('admin/game/edit/{uuid}','Admin\GameController@edit')->name('admin.game.edit');
    Route::post('admin/game/update','Admin\GameController@update')->name('admin.game.update');
    Route::post('admin/game/delete','Admin\GameController@delete')->name('admin.game.delete');
    Route::get('admin/game/restore/{uuid}','Admin\GameController@restore')->name('admin.game.restore');
    Route::get('admin/game/destroy/{uuid}','Admin\GameController@destroy')->name('admin.game.destroy');
    
    Route::get('admin/serie','Admin\SerieController@index')->name('admin.serie.index');
    Route::post('admin/serie','Admin\SerieController@index')->name('admin.serie.search');
    Route::get('admin/serie/create','Admin\SerieController@create')->name('admin.serie.create');
    Route::post('admin/serie/store','Admin\SerieController@store')->name('admin.serie.store');
    Route::get('admin/serie/show/{uuid}','Admin\SerieController@show')->name('admin.serie.show');
    Route::post('admin/serie/add','Admin\SerieController@add')->name('admin.serie.add');
    Route::post('admin/serie/game','Admin\SerieController@game')->name('admin.serie.game');
    Route::post('admin/serie/ungame','Admin\SerieController@ungame')->name('admin.serie.ungame');
    Route::post('admin/serie/delete','Admin\SerieController@delete')->name('admin.serie.delete');
    Route::get('admin/serie/restore/{uuid}','Admin\SerieController@restore')->name('admin.serie.restore');
    Route::get('admin/serie/destroy/{uuid}','Admin\SerieController@destroy')->name('admin.serie.destroy');
    
});

Route::get('/','HomeController@index')->name('public.index');
Route::get('about','HomeController@about')->name('public.about');
Route::get('api','HomeController@api')->name('public.api');
Route::get('goto/{uuid}','Frontend\SourceController@click')->name('public.click');

// ./console
Route::get('console','Frontend\ConsoleController@index')->name('public.console.index');
Route::post('console','Frontend\ConsoleController@index')->name('public.console.search');
Route::get('console/show/{uuid}','Frontend\ConsoleController@show')->name('public.console.show');
// ./contact
Route::get('contact','Frontend\ContactController@index')->name('public.contact.index');
Route::post('contact','Frontend\ContactController@index')->name('public.contact.search');
Route::get('contact/show/{uuid}','Frontend\ContactController@show')->name('public.contact.show');
Route::get('contact/map','Frontend\ContactController@globe')->name('public.contact.map');
// ./game
Route::get('game','Frontend\GameController@index')->name('public.game.index');
Route::post('game','Frontend\GameController@index')->name('public.game.search');
Route::get('game/show/{uuid}','Frontend\GameController@show')->name('public.game.show');
// ./genre
Route::get('genre','Frontend\GenreController@index')->name('public.genre.index');
Route::post('genre','Frontend\GenreController@index')->name('public.genre.search');
Route::get('genre/show/{uuid}','Frontend\GenreController@show')->name('public.genre.show');
// ./manufacturer
Route::get('manufacturer','Frontend\ManufacturerController@index')->name('public.manufacturer.index');
Route::post('manufacturer','Frontend\ManufacturerController@index')->name('public.manufacturer.search');
Route::get('manufacturer/show/{uuid}','Frontend\ManufacturerController@show')->name('public.manufacturer.show');
// ./podcast
Route::get('podcast','Frontend\PodcastController@index')->name('public.podcast.index');
Route::post('podcast','Frontend\PodcastController@index')->name('public.podcast.search');
Route::get('podcast/show/{uuid}','Frontend\PodcastController@show')->name('public.podcast.show');
// ./episode
Route::get('episode','Frontend\EpisodeController@index')->name('public.episode.index');
Route::post('episode','Frontend\EpisodeController@index')->name('public.episode.search');
Route::get('episode/show/{uuid}','Frontend\EpisodeController@show')->name('public.episode.show');
// ./stats
Route::get('stats/contacts','Frontend\StatisticsController@contacts')->name('public.stats.contacts');
Route::get('stats/countries','Frontend\StatisticsController@countries')->name('public.stats.countries');
Route::get('stats/episodes','Frontend\StatisticsController@episodes')->name('public.stats.episodes');
Route::get('stats/seasons/{season?}','Frontend\StatisticsController@seasons')->where('season', '[0-9]+')->name('public.stats.seasons');
Route::get('stats/games','Frontend\StatisticsController@games')->name('public.stats.games');
Route::get('stats/manufacturers','Frontend\StatisticsController@manufacturers')->name('public.stats.manufacturers');
Route::get('stats/series','Frontend\StatisticsController@series')->name('public.stats.series');
Route::get('stats/studios','Frontend\StatisticsController@studios')->name('public.stats.studios');
Route::get('stats/tracks','Frontend\StatisticsController@tracks')->name('public.stats.tracks');
// ./studio
Route::get('studio','Frontend\StudioController@index')->name('public.studio.index');
Route::post('studio','Frontend\StudioController@index')->name('public.studio.search');
Route::get('studio/show/{uuid}','Frontend\StudioController@show')->name('public.studio.show');
// ./track
Route::get('track','Frontend\TrackController@index')->name('public.track.index');
Route::post('track','Frontend\TrackController@index')->name('public.track.search');
Route::get('track/type/{type}','Frontend\TrackController@types')->name('public.track.type');
Route::get('track/show/{uuid}','Frontend\TrackController@show')->name('public.track.show');