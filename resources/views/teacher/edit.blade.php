<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Teacher Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> 
</head>
<body>
@include('header')
<br>
    <div class="container">
        <div class="d-flex justify-content-between py-3">
            <div class="h3">
                Edit a Teacher's Bio
            </div>
            <div>
                <a href="/teachers" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>

    <div class="container py-6">
    <form action="{{ route('teacher.update', $teacher->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    <div class= "card border-1 shadow-lg">
        <div class="card-body">
        
           <div class= "mb-3">
            <label for="t_name" class="form-label">Name</label>
            <input type="text" name="t_name" id="t_name" placeholder="Enter Name" class="form-control @error('t_name') is-invalid @enderror" value="{{ old('t_name', $teacher->t_name) }}">
            @error('t_name') <p class="invalid-feedback">{{ $message }}</p> @enderror
           </div> 

           <div class="form-row">
           <div class= "col-md-4 mb-3">
            <label for="t_des" class="form-label">Description</label>
            <input type="text" name="t_des" id="t_des" placeholder="Enter Description" class="form-control @error('t_des') is-invalid @enderror"  value="{{ old('t_des', $teacher->t_des) }}">
            @error('t_des') <p class="invalid-feedback">{{ $message }}</p> @enderror
           </div> 

           <div class= "col-md-4 mb-3">
            <label for="t_email" class="form-label">Email</label>
            <input type="text" name="t_email" id="t_email" placeholder="Enter Email" class="form-control @error('t_email') is-invalid @enderror"  value="{{ old('t_email', $teacher->t_email) }}">
            @error('t_email') <p class="invalid-feedback">{{ $message }}</p> @enderror
           </div> 

           <div class= "col-md-4 mb-3">
            <label for="t_phone" class="form-label">Phone</label>
            <input type="text" name="t_phone" id="t_phone" placeholder="Enter Phone" class="form-control @error('t_phone') is-invalid @enderror"  value="{{ old('t_phone', $teacher->t_phone) }}">
            @error('t_phone') <p class="invalid-feedback">{{ $message }}</p> @enderror
           </div> 
           </div>

           <div class="form-row">
           <div class= "col">
            <label for="t_aq" class="form-label">Academic Qualification & Other Publications</label>
            <textarea id="t_aq" name="t_aq" class="form-control" rows="4" required>{{ $teacher->t_aq }}</textarea>
            
            @error('t_aq') <p class="invalid-feedback">{{ $message }}</p> @enderror
           </div> 
           </div>
           <br>
           <div class= "mb-3">
            <label for="t_image" class="form-label">Add Photo (Required format: jpeg, jpg, png, bmp)</label><br>
            <input type="file" name="t_image" class="@error('t_image') is-invalid @enderror">
            @error('t_image') <p class="invalid-feedback">{{ $message }}</p> @enderror <br><br>
            @if($teacher->t_image && file_exists(public_path('uploads/teachers/' . $teacher->t_image)))
                <img src="{{ url('uploads/teachers/'.$teacher->t_image) }}" alt="" width="100" height="100">
            @endif
           </div> 
           <button class="btn btn-primary mt-2">Update Teacher's Information</button>
        </div>
    </div>
    </form></div>


<br><br><br>
@include('footer')
</body>
</html>
