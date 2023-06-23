@extends('layouts.app')

@section('content')
    <div class="d-flex">
        <h1 class="h2 float-start">Campaigns</h1>
        <p class="w-100"><a class="float-end btn btn-primary" href="{{ url('campaigns/create') }}">New</a></p>
    </div>
    <hr />
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Event Type</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($campaigns as $key => $campaign)
                    <tr>
                        <th scope="row">{{ $campaigns->firstItem() + $key }}</th>
                        <td>{{ $campaign->title }}</td>
                        <td>{{ $campaign->subject }}</td>
                        <td>{{ $campaign->event_type }}</td>
                        <td>{{ \Illuminate\Support\Carbon::parse($campaign->start_date)->format('d/m/Y') }}</td>
                        <td>{{ \Illuminate\Support\Carbon::parse($campaign->end_date)->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No data found</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    <div class="d-flex">
        {!! $campaigns->links() !!}
    </div>
@endsection
