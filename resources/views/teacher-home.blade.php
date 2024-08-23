<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .action-buttons {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>
    @include('header')
    <div class="container">
        <h2 class="mt-4">Teacher Dashboard</h2>
        
        @if(Session::has('success'))
    <center><div class="alert alert-success" style="width:86%">
        {{Session::get('success')}}
    </div></center>
@endif

        <div class="card mt-4">
            <div class="card-header">
                <h3>{{ $teacher->t_name }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        @if($teacher->t_image && file_exists(public_path('uploads/teachers/' . $teacher->t_image)))
                            <img src="{{ asset('uploads/teachers/' . $teacher->t_image) }}" alt="Teacher Image" style="width: 120px; height: 160px;" class="img-fluid">
                        @else
                            <img src="{{ asset('uploads/no-image.png') }}" alt="No Image" style="width: 120px; height: 160px;" class="img-fluid">
                        @endif
                    </div>
                    <div class="col-md-9">
                        <p><strong>Designation:</strong> {{ $teacher->t_des }}</p>
                        <p><strong>Email:</strong> <a href="mailto:{{ $teacher->t_email }}">{{ $teacher->t_email }}</a></p>
                        <p><strong>Phone:</strong> {{ $teacher->t_phone }}</p>
                        <p><strong>Academic Qualification  & Other Publications:</strong><br> {!! nl2br(e($teacher->t_aq)) !!}</p>
                        <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    </div>
                </div>
            </div>
        </div>



        <div class="card mt-3">
                <div class="card-body">
                     <div class="d-flex justify-content-between py-">
                     <div class="h3">Assigned Courses</div>
                     <div>
                         <a href="{{ route('news.index') }}" class="btn btn-primary">Manage News</a>
                     </div>
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>Course ID</th>
                        <th>Teacher ID</th>
                        <th>Teacher Name</th>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Semester</th>
                        <th>Section</th>
                        <th>Action</th>
                    </tr>
                    @if($courses->isNotEmpty())
                        @foreach($courses as $course)
                            <tr valign="middle">
                                <th>{{ $course->id }}</th>
                                <td>{{ $course->t_id }}</td>
                                <td>{{ $course->t_name }}</td>
                                <td>{{ $course->c_code }}</td>
                                <td>{{ $course->c_title }}</td>
                                <td>{{ $course->c_semester }}</td>
                                <td>{{ $course->c_section }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('course.view', $course->id) }}" class="btn btn-primary btn-sm">Details</a>
                                        <a href="{{ route('news.create', ['c_id' => $course->id, 'c_code' => $course->c_code]) }}" class="btn btn-primary btn-sm">Post News</a>
                                        <a href="{{ route('course.edit', $course->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('course.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="10">Record Not Found</td></tr>
                    @endif
                </table>
            </div>
        </div>
    </div><br>
    @include('footer')
</body>
</html>
