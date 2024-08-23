<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Management</title>
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
            <div class="h3">Available Teachers</div>
        </div>
        <div class="col-md-4 text-center">
            <form action="{{ route('teacher.index') }}" method="GET" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search by Name or Email" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <div class="col-md-4 text-right">
            <a href="/teachers_create" class="btn btn-primary">Add New Teacher</a>
            <a href="/courses" class="btn btn-secondary">View Courses</a> 
        </div>
    </div>
</div>

@if(Session::has('success'))
    <center><div class="alert alert-success" style="width:86%">
        {{Session::get('success')}}
    </div></center>
@endif

<center>
    <div class="border-2 shadow-lg" style="width: 93%;">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Teacher ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Academic Qualification & Other Publications</th>
                    <th>Action</th>
                </tr>
                @if($teachers->isNotEmpty())
                    @foreach($teachers as $teacher)
                        <tr valign="middle">
                            <th>{{ $teacher->id }}</th>
                            <td>
                                @if($teacher->t_image && file_exists(public_path('uploads/teachers/' . $teacher->t_image)))
                                    <img src="{{ url('uploads/teachers/'.$teacher->t_image) }}" alt="" width="60" height="60" class="rounded-circle">
                                @else
                                    <img src="{{ url('uploads/no-image.png') }}" alt="" width="60" height="60" class="rounded-circle">
                                @endif
                            </td>
                            <td>{{ $teacher->t_name }}</td>
                            <td>{{ $teacher->t_des }}</td>
                            <td><a href="mailto:{{ $teacher->t_email }}">{{ $teacher->t_email }}</a></td> 
                            <td>{{ $teacher->t_phone }}</td>
                            <td>{!! nl2br(e($teacher->t_aq)) !!}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('course.create', ['t_id' => $teacher->id, 't_name' => $teacher->t_name]) }}" class="btn btn-primary btn-sm">Assign Course</a>
                                    <a href="{{ route('teacher.edit',$teacher->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="#" onclick="deleteTeacher({{ $teacher->id }})" class="btn btn-danger btn-sm">Delete</a>
                                    <form id="teacher-edit-action-{{ $teacher->id }}" action="{{ route('teacher.destroy',$teacher->id) }}" method="post">
                                        @csrf 
                                        @method('delete')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="8">Record Not Found</td></tr>
                @endif
            </table>
        </div>
    </div>
</center><br>
@include('footer')
</body>
</html>

<script>
    function deleteTeacher(id){
        if(confirm("Are you sure?")){
            document.getElementById('teacher-edit-action-'+id).submit();
        }
    }
</script>
