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
                        <th>Actions</th>
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
                            <td>
                                <button class="btn btn-primary btn-sm reply-btn" data-id="{{ $contact->id }}" data-email="{{ $contact->user_email }}" data-name="{{ $contact->user_name }}">Reply</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Reply Modal -->
        <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="replyModalLabel">Reply to Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('contact.reply') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="contact_id" id="contact_id">
                            <input type="hidden" name="email" id="email">
                            <div class="form-group">
                                <label for="name">To:</label>
                                <input type="text" id="name" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="reply_message">Message:</label>
                                <textarea name="reply_message" id="reply_message" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.reply-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const email = this.getAttribute('data-email');
            const name = this.getAttribute('data-name');

            document.getElementById('contact_id').value = id;
            document.getElementById('email').value = email;
            document.getElementById('name').value = name;

            $('#replyModal').modal('show');
        });
    });
</script>
@endsection
