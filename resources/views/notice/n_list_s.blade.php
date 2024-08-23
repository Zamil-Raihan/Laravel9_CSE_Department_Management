<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    @include('header')

    <div class="container">
        <div class="d-flex justify-content-between py-3">
            <div class="h3">Notice List</div>
            <div>
                <a href="/" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date and Time</th>
                        <th>Notice</th>
                        <th>Attachment</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notices as $notice)
                        <tr>
                            <td>{{ $notice->created_at }}</td>
                            <td>{!! nl2br(e($notice->notice)) !!}</td>
                            <td>
                                @if($notice->attachment)
                                    <a href="{{ asset('uploads/notices/' . $notice->attachment) }}">Download</a>
                                @else
                                    No Attachment
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No notices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('footer') 
</body>
</html>
