@extends('layouts.app')

@section('content')
    <h1 class="h2">New Campaigns</h1>
    @if ($errors->any())
        <div class="text-danger mt-1">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('campaigns.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" value="{{ old('title') }}" class="form-control" id="title" name="title" required>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" value="{{ old('subject') }}" id="subject" name="subject" required>
                    @if ($errors->has('subject'))
                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="event_type" class="form-label">Event Type</label>
                    <select class="form-select" id="event_type" name="event_type" required>
                        <option value="" selected>Select event type</option>
                        <option value="Webinar" {{ old('event_type') == 'Webinar'?'selected':'' }}>Webinar</option>
                        <option value="Webinar with login URL" {{ old('event_type') == 'Webinar with login URL'?'selected':'' }}>Webinar with login URL</option>
                      </select>
                    @if ($errors->has('event_type'))
                        <span class="text-danger">{{ $errors->first('event_type') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" value="{{ old('start_date') }}" class="form-control" id="start_date" name="start_date" required>
                    @if ($errors->has('start_date'))
                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" value="{{ old('end_date') }}" class="form-control" id="end_date" name="end_date" required>
                    @if ($errors->has('end_date'))
                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="description" class="form-label">Calendar Invite Description</label>
                    <textarea class="form-control" id="description" name="description" rows="10">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>
@endsection
