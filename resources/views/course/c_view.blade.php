<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> 
</head>
<body>
    @include('header') 
    <div class="container">
        <div class="d-flex justify-content-between py-3">
            <div class="h3">
                Details
            </div>
            <div>
                <a href="/courses" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>

    <div class="container py-6">
        <form action="{{ route('course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card border-1 shadow-lg p-4">
                <div class="form-group row">
                    <div class="col">
                        <label for="t_id">Teacher ID:</label>
                        <input type="text" id="t_id" name="t_id" class="form-control" value="{{ $course->t_id }}" readonly="readonly" required>
                    </div>
                    <div class="col">
                        <label for="t_name">Teacher Name:</label>
                        <input type="text" id="t_name" name="t_name" class="form-control" value="{{ $course->t_name }}" readonly="readonly" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="c_code">Course Code:</label>
                        <input type="text" id="c_code" name="c_code" class="form-control" value="{{ $course->c_code }}" readonly="readonly" required>
                    </div>
                    <div class="col">
                        <label for="c_title">Course Title:</label>
                        <input type="text" id="c_title" name="c_title" class="form-control" value="{{ $course->c_title }}" readonly="readonly" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="c_semester">Semester:</label>
                        <input type="text" id="c_semester" name="c_semester" class="form-control" value="{{ $course->c_semester }}" readonly="readonly" required>
                    </div>
                    <div class="col">
                        <label for="c_section">Section:</label>
                        <input type="text" id="c_section" name="c_section" class="form-control" value="{{ $course->c_section }}" readonly="readonly" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="c_out">Course Outline: <a href="{{ asset('uploads/courses/' . $course->c_out) }}">Download</a></label>
                    </div>
                    <div class="col">
                        <label for="c_mat">Course Material: <a href="{{ asset('uploads/courses/' . $course->c_mat) }}">Download</a></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="c_student">Students:</label>
                    <textarea id="c_student" name="c_student" class="form-control" rows="4" readonly="readonly">{{ $course->c_student }} </textarea>
                </div>
                <a href="{{ route('course.edit', $course->id) }}" class="btn btn-primary btn-sm">Edit</a>
            </div>
        </form>
    </div>
<br>
    @include('footer') 
</body>
</html>
