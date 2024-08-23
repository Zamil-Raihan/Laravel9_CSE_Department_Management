<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    @include('header')

    <div class="container">
        <div class="d-flex justify-content-between py-3">
            <div class="h3">Feedback List</div>
            <div>
                <a href="/admin_panel" class="btn btn-primary">Back</a>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Teacher ID</th>
                        <th>Teacher Name</th>
                        <th>Course ID</th>
                        <th>Course Code</th>
                        <th>Feedback</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->id }}</td>
                            <td>{{ $feedback->s_id }}</td>
                            <td>{{ $feedback->t_id }}</td>
                            <td>{{ $feedback->t_name }}</td>
                            <td>{{ $feedback->c_id }}</td>
                            <td>{{ $feedback->c_code }}</td>
                            <td>{!! nl2br(e($feedback->feedback)) !!}</td>
                            <td>{{ $feedback->created_at }}</td>
                            <td>
                                <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">No feedbacks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('footer')
</body>
</html>
