<?php

namespace CryptaEve\Seat\MoonBot\Http\Controllers;

use Seat\Web\Http\Controllers\Controller;
use CryptaEve\Seat\MoonBot\Models\Api;
use CryptaEve\Seat\MoonBot\Models\CorpPivot;
use CryptaEve\Seat\MoonBot\Validation\AddMoonBotApi;
use Illuminate\Database\QueryException;
use Seat\Eveapi\Models\Corporation\CorporationInfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Seat\Eveapi\Bus\Corporation;
use Seat\Eveapi\Jobs\Industry\Corporation\Mining\ObserverDetails;
use Seat\Eveapi\Jobs\Industry\Corporation\Mining\Observers;
use Seat\Eveapi\Models\Industry\CorporationIndustryMiningExtraction;
use Seat\Eveapi\Models\Industry\CorporationIndustryMiningObserver;
use Seat\Eveapi\Models\RefreshToken;
use Seat\Web\Models\UniverseMoonReport;

class MoonBotController extends Controller 
{

    public function getConfigureView()
    {

        $corps = CorporationInfo::all();
        $apis = Api::all();
        return view("moonbot::configure", compact('corps', 'apis'));
    }

    public function postNewApi(AddMoonBotApi $request)
    {
        try{
            
            $api = new Api();
            $api->name = request()->name;
            $api->slug = Str::uuid();
            $api->token = Str::random(40);
            $api->upcoming = false;

            $api->save();
            $api = $api->fresh();

            foreach($request->corporations as $corp)
            {
                $cp = new CorpPivot();
                $cp->api_id = $api->id;
                $cp->corp_id = $corp;
                $cp->save();
            }
    
            return redirect()->route('moonbot.configure')->with('success', 'Created New API');
        }
        catch (QueryException $e)
        {
            return redirect()->route('moonbot.configure')->with('error', 'Error creating API! - ' . $e);
        }
        
    }

    public function getPublicData(Request $request, string $slug)
    {

        $api = Api::where('slug', $slug)->firstOrFail();
        $header = $request->header('Authorization');

        if ($header != $api->token){
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // This is just for testing the mined amount


        $extractions = CorporationIndustryMiningExtraction::with(
            'moon', 'moon.solar_system', 'moon.constellation', 'moon.region',
            'moon.moon_report', 'moon.moon_report.content', 'structure', 'structure.info')
            ->whereIn('corporation_id', $api->corporations->pluck('corporation_id'))
            ->where('natural_decay_time', '>', carbon()->subSeconds(CorporationIndustryMiningExtraction::THEORETICAL_DEPLETION_COUNTDOWN))
            ->get();

        foreach($extractions as $extraction) {
            $extraction->observer = CorporationIndustryMiningObserver::with('entries')
            ->where('observer_id', $extraction->structure_id)
            ->first();
        }

        return response()->json($extractions);
    }

    public function deleteApiById($id)
    {
        Api::destroy($id);

        return redirect()->route('moonbot.configure')->with('success', 'Deleted API');
    }

    public function processUpdateApi(Request $request, string $slug)
    {

        $api = Api::where('slug', $slug)->firstOrFail();
        $header = $request->header('Authorization');

        if ($header != $api->token){
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        RefreshToken::whereHas('character.affiliation', function ($query) use ($api){
            $query->whereIn('corporation_id', $api->corporations->pluck('corporation_id'));
        })->whereHas('character.corporation_roles', function ($query) {
            $query->where('scope', 'roles');
            $query->where('role', 'Director');
        })->get()->unique('character.affiliation.corporation_id')->each(function ($token) {
            Observers::dispatchNow($token->character->affiliation->corporation_id, $token);
            ObserverDetails::dispatchNow($token->character->affiliation->corporation_id, $token);
        });
        
        return response()->json(['status' => 'success']);
    }

    public function getAboutView()
    {
        return view("moonbot::about");
    }

}
