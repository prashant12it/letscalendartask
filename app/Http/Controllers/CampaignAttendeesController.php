<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Imports\AttendeesImport;
use App\Jobs\SendInviteJob;
use App\Models\CampaignAttendees;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CampaignAttendeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campaigns = Campaign::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('upload-attendees', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            [
                'file' => $request->file,
                'extension' => strtolower($request->file->getClientOriginalExtension()),
                'campaign_id' => $request->campaign_id
            ],
            [
                'file' => 'required',
                'extension' => 'required|in:csv,xlsx',
                'campaign_id' => 'required'
            ],
            [
                'file.*' => 'Please upload a valid data file in excel or csv format',
                'extension.*' => 'Please upload a valid data file in excel or csv format',
                'campaign_id.*' => 'Select a valid campaign'
            ]
        );
        if ($validator->fails()) {
            return back()->withInput($request->input())->withErrors($validator->errors());
        }
        try {
            Excel::import(new AttendeesImport($request), $request->file('file'));
            return back()->with('success', 'Data has been imported!');
        } catch (Exception $e) {
            return back()->withInput($request->input())->withErrors(json_decode($e->getMessage(), JSON_OBJECT_AS_ARRAY));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CampaignAttendees $campaignAttendees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CampaignAttendees $campaignAttendees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CampaignAttendees $campaignAttendees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampaignAttendees $campaignAttendees)
    {
        //
    }
    public function invite(Request $request)
    {
        $campaigns = CampaignAttendees::join('campaigns', 'campaign_attendees.campaign_id', '=', 'campaigns.id')
            ->where([['campaigns.user_id', '=', Auth::user()->id], ['campaign_attendees.invite_sent', '=', 0]])
            ->get()->unique();
        return view('send-invite', compact('campaigns'));
    }
    public function sendInvite(Request $request)
    {
        $attendees = CampaignAttendees::with(['campaign', 'users'])->where([['campaign_id', '=', $request->campaign_id], ['invite_sent', '=', 0]])->get();
        if(!empty($attendees)){
            foreach($attendees as $attendee){
                $emailData = [
                    'id' => $attendee->id,
                    'subject' => $attendee->campaign->subject,
                    'name' => $attendee->users->name,
                    'email' => $attendee->users->email,
                    'title' => $attendee->campaign->title,
                    'description' => $attendee->campaign->description,
                    'event_type' => $attendee->campaign->event_type,
                    'start_date' => Carbon::parse($attendee->campaign->start_date)->format('d/m/Y') ,
                    'end_date' => Carbon::parse($attendee->campaign->end_date)->format('d/m/Y') ,
                ];
                try {
                    SendInviteJob::dispatch($emailData);
                } catch (Exception $e) {
                    return back()->withInput($request->input())->withErrors('Something goes wrong, please try later');
                }
            }
        }
        return back()->with('success', 'Invite sent successfully');
    }
}