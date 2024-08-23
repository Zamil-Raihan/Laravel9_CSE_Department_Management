<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit News</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    @include('header')

    <div class="container py-6">
        <div class="d-flex justify-content-between py-3">
            <div class="h3">Edit News for course <b> {{ $news->c_code }}</b> on {{ $news->created_at }}</div>
            <div>
                <a href="{{ route('news.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <form action="{{ route('news.update', $news->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card border-1 shadow-lg p-4">
                <input type="hidden" id="t_name" name="t_name" class="form-control" value="{{ auth()->user()->name }}">
                <input type="hidden" id="c_id" name="c_id" class="form-control" required value="{{ $news->c_id }}">
                <input type="hidden" id="c_code" name="c_code" class="form-control" required value="{{ $news->c_code }}">
                <div class="form-group">
                    <textarea id="news" name="news" class="form-control" rows="4" required>{{ $news->news }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    @include('footer')
</body>

</html>