<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    @include('header')

    <div class="container">
        <div class="d-flex justify-content-between py-3">
            <div class="h3">News List</div>
            <div>
                <a href="/home_teacher" class="btn btn-primary">Back</a>
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
                        <th>Course ID</th>
                        <th>Course Code</th>
                        <th colspan="3">News</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($news as $newsItem)
                        <tr>
                            <td>{{ $newsItem->created_at }}</td>
                            <td>{{ $newsItem->c_id }}</td>
                            <td>{{ $newsItem->c_code }}</td>
                            <td colspan="3">{!! nl2br(e($newsItem->news)) !!}</td>
                            <td>
                                <a href="{{ route('news.edit', $newsItem->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('news.destroy', $newsItem->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this news?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No news found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('footer')
</body>

</html>