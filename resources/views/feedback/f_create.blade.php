<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Feedback</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    @include('header')

    <div class="container py-6">
        <div class="d-flex justify-content-between py-3">
            <div class="h3">Write Feedback on teacher <b> {{ $t_name }}</b> for course <b> {{ $c_code }}</b> </div>
            <div>
                <a href="/courses_s" class="btn btn-primary">Back</a>
            </div>
        </div>
        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf
            <input type="hidden" name="t_id" value="{{ $t_id }}">
            <input type="hidden" name="t_name" value="{{ $t_name }}">
            <input type="hidden" name="c_id" value="{{ $c_id }}">
            <input type="hidden" name="c_code" value="{{ $c_code }}">
            <input type="hidden" name="s_id" value="{{ auth()->user()->name }}">
                <div class="form-group">
                    <textarea id="feedback" name="feedback" class="form-control" rows="4" required>{{ old('feedback') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div><br>

    @include('footer')
</body>
</html>
