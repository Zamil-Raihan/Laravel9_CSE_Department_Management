<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>
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
        <div class="row justify-content-between align-items-center py-3">
            <div class="col-md-4">
                <div class="h3">Available Courses</div>
            </div>
            <div class="col-md-4 text-center">
                <form action="{{ route('course.index') }}" method="GET" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search by Name, Code, Title, Semester, or Section" aria-label="Search" name="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <div class="col-md-4 text-right">
                <a href="/teachers" class="btn btn-primary">See Teachers List</a>
            </div>
        </div>
    </div>

    @if(Session::has('success'))
        <center>
            <div class="alert alert-success" style="width:86%">
                {{ Session::get('success') }}
            </div>
        </center>
    @endif

    <center>
        <div class="border-2 shadow-lg" style="width: 93%;">
            <div class="card-body">
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
    </center><br>
    @include('footer')
</body>
</html>

<script>
    function deleteCourse(id){
        if(confirm("Are you sure?")){
            document.getElementById('course-edit-action-'+id).submit();
        }
    }
</script>
