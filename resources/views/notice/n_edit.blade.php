<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    @include('header')

    <div class="container py-6">
        <div class="d-flex justify-content-between py-3">
            <div class="h3">Edit Notice</div>
            <div>
                <a href="{{ route('notice.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <form action="{{ route('notice.update', $notice->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card border-1 shadow-lg p-4">
                <div class="form-group">
                    <label for="notice">Notice:</label>
                    <textarea id="notice" name="notice" class="form-control" rows="4" required>{{ $notice->notice }}</textarea>
                </div>
                <div class="form-group">
                    <label for="attachment">Attachment (Optional):</label>
                    <input type="file" id="attachment" name="attachment" class="form-control-file">
                </div>
                @error('attachment')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    @include('footer')
</body>
</html>
