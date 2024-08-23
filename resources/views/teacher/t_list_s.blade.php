<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
@include('header')
<div class="container">
    <div class="row justify-content-between align-items-center py-3">
        <div class="col-md-4">
            <div class="h3">Department Teachers</div>
        </div>
        <div class="col-md-4 text-center">
            <form action="{{ route('teacher.index_public') }}" method="GET" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search by Name" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <div class="col-md-4 text-right">
            <a href="/courses_s" class="btn btn-primary">See Courses List</a>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        @if($teachers->isNotEmpty())
            @foreach($teachers as $teacher)
                <div class="col-md-3 mb-4"> 
                    <div class="card">
                        <img src="{{ $teacher->t_image ? url('uploads/teachers/'.$teacher->t_image) : url('uploads/no-image.png') }}" class="card-img-top" alt="Teacher Image" style="width: 250px; height: 310px;">
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ $teacher->t_name }}</b></h5>
                            <p class="card-text">{{ $teacher->t_des }}</p>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#teacherModal{{ $teacher->id }}">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Teacher Modal -->
                <div class="modal fade" id="teacherModal{{ $teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="teacherModalLabel{{ $teacher->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="teacherModalLabel{{ $teacher->id }}">{{ $teacher->t_name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Designation:</strong> {{ $teacher->t_des }}</p>
                                <p><strong>Email:</strong> <a href="mailto:{{ $teacher->t_email }}">{{ $teacher->t_email }}</a></p>
                                <p><strong>Phone:</strong> {{ $teacher->t_phone }}</p>
                                <p><strong>Academic Qualification & Other Publications:</strong> <br> {!! nl2br(e($teacher->t_aq)) !!}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                    Record Not Found
                </div>
            </div>
        @endif
    </div>
</div>

@include('footer')
</body>
</html>
