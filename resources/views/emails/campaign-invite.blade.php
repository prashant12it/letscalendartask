<!DOCTYPE html>
<html>
<head>
    <title>Campaign Invite</title>
    <style>
        .btn-primary{
            position: relative;
            color: #eee;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            border: 1px solid #ddd;
            background-color: #24293D;
            box-shadow: none;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <h2>Hey {{ $details['name'] }}</h2>
    <h4>Congratulations! You're invited to <b>{{ $details['title'] }}</b> campaign.</h4>
    
    <h5>Campaign Details</h5>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Event Type</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $details['title'] }}</td>
                <td>{{ $details['start_date'] }}</td>
                <td>{{ $details['end_date'] }}</td>
                <td>{{ $details['event_type'] }}</td>
            </tr>
        </tbody>
        <p>
            {!! $details['description'] !!}
        </p>
    </table>
   
    <p>Thank you</p>
</body>
</html>