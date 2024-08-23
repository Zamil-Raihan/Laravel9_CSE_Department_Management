<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create News</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    @include('header')

    <div class="container py-6">
        <div class="d-flex justify-content-between py-3">
            <div class="h3">Write New News for course <b> {{ $c_code }}</b></div>
            <div>
                <a href="/home_teacher" class="btn btn-primary">Back</a>
            </div>
        </div>
        <form action="{{ route('news.store') }}" method="POST">
            @csrf
            <input type="hidden" name="t_name" class="form-control" value="{{ auth()->user()->name }}">
            <input type="hidden" name="c_id" class="form-control" value="{{ $c_id }}">
            <input type="hidden" name="c_code" class="form-control" value="{{ $c_code }}">
            <div class="form-group">
                <textarea id="news" name="news" class="form-control" rows="4" required>{{ old('news') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
    </div><br>
    @include('footer')
</body>

</html>