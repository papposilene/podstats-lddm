<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\ContactHasTrack;
use App\EpisodeHasStaff;
use App\EpisodeHasTrack;
use App\GameHasStaff;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRelationEpisode;
use App\Http\Requests\StoreRelationGame;
use App\Http\Requests\StoreRelationTrack;
use App\Http\Requests\DeleteRelation;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a link between a contact and an episode
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createEpisode(StoreRelationEpisode $request)
    {
        $validated = $request->validated();
        
        if (auth()->user()->can('update')) {
            // If the contact doesn't exist yet
            $contact_name = $request->input('staff_uname');
            $contact_uuid = $request->input('staff_uuid');
            if ($contact_uuid)
            {
                $quidam = Contact::findOrFail($contact_uuid);
            }
            else
            {
                $quidam = new Contact;
                $quidam->uname = $contact_name;
                $quidam->save();
            }
            
            $link = new EpisodeHasStaff;
            $link->podcast_uuid = $request->input('podcast_uuid');
            $link->episode_uuid = $request->input('episode_uuid');
            $link->contact_uuid = $quidam->uuid;
            $link->profession_uuid = $request->input('profession_uuid');
            $link->save();
        }
		
        return redirect()->back();
    }
    
    /**
     * Create a link between a contact and a game
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createGame(StoreRelationGame $request)
    {
        $validated = $request->validated();
        
        if (auth()->user()->can('create')) {
            // If the contact doesn't exist yet
            $contact_name = $request->input('contact_uname');
            $contact_uuid = $request->input('contact_uuid');
            if($contact_name && empty($contact_uuid))
            {
                $quidam = new Contact;
                $quidam->uname = $contact_name;
                $quidam->save();
            }
            else
            {
                $quidam = Contact::findOrFail($contact_uuid);
            }
            
            $link = new GameHasStaff;
            $link->game_uuid = $request->input('game_uuid');
            $link->contact_uuid = $quidam->uuid;
            $link->profession_uuid = $request->input('profession_uuid');
            $link->save();
        }
		
        return redirect()->back();
    }
    
    /**
     * Create a link between a contact and a track
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createTrack(StoreRelationTrack $request)
    {
        $validated = $request->validated();
        
        if (auth()->user()->can('create')) {
            // If the contact doesn't exist yet
            $contact_name = $request->input('contact_uname');
            $contact_uuid = $request->input('contact_uuid');
            if($contact_name && empty($contact_uuid))
            {
                $quidam = new Contact;
                $quidam->uname = $contact_name;
                $quidam->save();
            }
            else
            {
                $quidam = Contact::findOrFail($contact_uuid);
            }
            
            $link = new ContactHasTrack;
            $link->track_uuid = $request->input('track_uuid');
            $link->contact_uuid = $quidam->uuid;
            $link->save();
        }
		
        return redirect()->back();
    }
    
    /**
     * Delete a link between a contact and an episode
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteEpisode(DeleteRelation $request)
    {
        $validated = $request->validated();
        
        if (auth()->user()->can('delete')) {
            $unlink = EpisodeHasStaff::findOrFail($request->input('relation_uuid'));
            $unlink->delete();
        }
		
        return redirect()->back();
    }
    
    /**
     * Delete a link between a contact and a game
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteGame(DeleteRelation $request)
    {
        $validated = $request->validated();
        
        if (auth()->user()->can('delete')) {
            $unlink = GameHasStaff::findOrFail($request->input('relation_uuid'));
            $unlink->delete();
        }
		
        return redirect()->back();
    }
    
    /**
     * Delete a link between a contact and a track
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteTrack(DeleteRelation $request)
    {
        $validated = $request->validated();
        
        if (auth()->user()->can('delete')) {
            $unlink = ContactHasTrack::findOrFail($request->input('relation_uuid'));
            $unlink->delete();
        }
		
        return redirect()->back();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        //
    }
}
