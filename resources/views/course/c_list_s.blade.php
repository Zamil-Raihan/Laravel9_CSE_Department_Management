<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departmental Courses</title>
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
                <div class="h3">Departmental Courses</div>
            </div>
            <div class="col-md-4 text-center">
                <form action="{{ route('course.index_public') }}" method="GET" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search"
                        placeholder="Search by Name, Code, Title, Semester, or Section" aria-label="Search"
                        name="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <div class="col-md-4 text-right">
                <a href="/teachers_s" class="btn btn-primary">See Teachers List</a>
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

    <div class="container">
        <div class="row">
            @if($courses->isNotEmpty())
                @foreach($courses as $course)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><b>{{ $course->c_code }}</b></h4>
                                <p><b>{{ $course->c_title }}</b></p>
                                <p class="card-text">
                                    Section: {{ $course->c_section }}<br>
                                    Semester: {{ $course->c_semester }}<br>
                                    Teacher: {{ $course->t_name }}<br>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        @if($course->c_out)
                                            <a href="{{ asset('uploads/courses/' . $course->c_out) }}"
                                                class="btn btn-primary btn-sm">Download Outline</a>
                                        @else
                                            <span class="text-muted">Outline Not Available</span>
                                        @endif
                                    </div>
                                    <div>
                                        @if($course->c_mat)
                                            <a href="{{ asset('uploads/courses/' . $course->c_mat) }}"
                                                class="btn btn-primary btn-sm">Download Material</a>
                                        @else
                                            <span class="text-muted">Material Not Available</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-secondary btn-sm mt-2" data-toggle="modal"
                                        data-target="#newsModal_{{ $course->id }}">View News</button>
                                    <button class="btn btn-secondary btn-sm mt-2" data-toggle="modal"
                                        data-target="#studentModal_{{ $course->id }}">Students</button>
                                    <a href="{{ route('feedback.create', ['t_id' => $course->t_id, 't_name' => $course->t_name, 'c_id' => $course->id, 'c_code' => $course->c_code]) }}"
                                        class="btn btn-secondary btn-sm mt-2">Write Feedback</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- News Modal -->
                    <div class="modal fade" id="newsModal_{{ $course->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="newsModalLabel_{{ $course->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 65%;" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newsModalLabel_{{ $course->id }}">News for
                                        <b>{{ $course->c_code }}</b> by <b>{{ $course->t_name }}</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 25%;">Posted At</th>
                                                <th style="width: 75%;">News</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($course->news->sortByDesc('created_at') as $newsItem)
                                                <tr>
                                                    <td>{{ $newsItem->created_at }}</td>
                                                    <td>{!! nl2br(e($newsItem->news)) !!}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Student Modal -->
                    <div class="modal fade" id="studentModal_{{ $course->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="studentModalLabel_{{ $course->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="studentModalLabel_{{ $course->id }}">Students took this Course:
                                        {{ $course->c_title }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>{!! nl2br(e($course->c_student)) !!}</p>
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
                        No courses found.
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('footer')
</body>
</html>