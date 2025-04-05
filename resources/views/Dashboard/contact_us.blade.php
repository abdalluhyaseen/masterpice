@extends('Dashboard.master')
@section('content')
<div class="page-container">
    <div class="main-content">

<div class="table-responsive table--no-card mb-4" style="max-width: 90%; margin: 0 auto;">
    <table class="table table-borderless table-striped table-earning">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th class="text-right">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->user_name }}</td>
                    <td>{{ $contact->user_email }}</td>
                    <td>{{ $contact->user_subject }}</td>
                    <td>{{ $contact->user_message }}</td>
                    <td class="text-right">{{ $contact->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>

@endsection
