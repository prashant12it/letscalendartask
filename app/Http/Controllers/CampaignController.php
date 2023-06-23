<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campaigns = Campaign::where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate(10);
        return view('home',compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('campaigns.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make(
            $data,[
            'title' => 'required|max:150',
            'subject' => 'required|max:150',
            'event_type' => 'required|in:Webinar,Webinar with login URL',
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'description' => 'max:1000'
        ], [
            'title.required' => 'Title is required',
            'title.max' => 'Title must not be greater than 150 characters',
            'subject.required' => 'Subject is required',
            'subject.max' => 'Subject must not be greater than 150 characters',
            'event_type.required' => 'Event type is required',
            'event_type.in' => 'Choose a valid event type',
            'start_date.required' => 'Start date is required',
            'start_date.date_format' => 'Start date format should be Y-m-d',
            'start_date.before_or_equal' => 'Start date must be a date before or equal to end date',
            'end_date.required' => 'End date is required',
            'end_date.date_format' => 'End date format should be Y-m-d',
            'end_date.after_or_equal' => 'End date must be a date after or equal to start date',
            'description.max' => 'Calendar Invite Description must not be greater than 1000 characters',
        ]);
        if ($validator->fails()) {
            return back()->withInput($request->input())->withErrors($validator->errors());
        }
        
        $data['user_id'] = Auth::user()->id;
        Campaign::create($data);
        session()->flash('success','Campaign created successfully');
        return redirect(url('/campaigns'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
