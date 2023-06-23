@extends('layouts.app')

@section('content')
    <h1 class="h2">Send Invite</h1>
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul class="mb-0 list-unstyled">
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    @if ($errors->any())
        <div class="text-danger mt-1">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('attendees.sendInvite') }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="campaign_id" class="form-label">Campaign</label>
                    <select class="form-select" id="campaign_id" name="campaign_id" required>
                        <option selected>Select Campaign</option>
                        @forelse ($campaigns as $campaign)
                            <option value="{{ $campaign->id }}" {{ old('campaign_id') == $campaign->id ? 'selected' : '' }}>
                                {{ $campaign->title }}</option>
                        @empty
                        @endforelse
                    </select>
                    @if ($errors->has('campaign_id'))
                        <span class="text-danger">{{ $errors->first('campaign_id') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
