<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
@include('header')
    <center><p style="font-size: 45px; font-family: Calibri;">
            <b>Welcome to Admin Dashboard</b>
    </p></center>
    <div class="container py-7" style="width: 60%;">
        <div class="d-flex justify-content-between">
            <div> 
            <a href="{{ route('teacher.index') }}" class= "btn btn-primary">View All Teacher Information</a>
            </div>
            <div>
            <a href="{{ route('teacher.create') }}" class= "btn btn-primary">Add New Teacher Information</a>
            </div>
        </div> 
        <br><br>
        <div class="d-flex justify-content-between">
            <div> 
            <a href="{{ route('course.index') }}" class= "btn btn-primary">View All Course Information</a>
            </div>
            <div>
            <a href="/feedbacks" class= "btn btn-primary">See All Feedbacks</a>
            </div>
        </div>
        <br><br>
        <div class="d-flex justify-content-between">
            <div> 
            <a href="{{ route('notice.index') }}" class= "btn btn-primary">View All Notices</a>
            </div>
            <div>
            <a href="{{ route('notice.create') }}" class= "btn btn-primary">Add New Notice</a>
            </div>
        </div>
        <br><br>
    </div><br>
</body>
@include('footer')
</html>
