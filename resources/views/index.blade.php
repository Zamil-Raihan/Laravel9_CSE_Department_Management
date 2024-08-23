<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUBTK CSE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .logo {
            max-width: 200px;
        }

        .toggle-icon {
            cursor: pointer;
        }

        .bg-purple {
            background-color: purple;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    @include('header')
    <center>
        @if (session('error'))
            <br>
            <div class="alert alert-success" role="alert" style="width: 70%; color: red; text-align: center;">
                {{ session('error') }}
            </div>

        @endif
    </center>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-body border border-purple" style="text-align: justify;">
                        <img src="logo2.png" alt="Logo2" class="logo mb-3">
                        <h3 class="card-title text-white">NUBTK CSE Department</h3>
                        <p>The Computer Science and Engineering (CSE) Department at the Northern University of Business
                            and Technology Khulna (NUBT Khulna) stands as a cornerstone in the institution's academic
                            framework. With a commitment to excellence in education, research, and innovation, the CSE
                            department plays a pivotal role in shaping the future of technology professionals in
                            Bangladesh. This assignment provides an in-depth overview of the CSE department, including
                            its objectives, academic programs, faculty, research initiatives, and contributions to the
                            broader community.</p>
                        <h4>Objectives</h4>
                        <p>The primary objective of the CSE department at NUBT Khulna is to equip students with the
                            knowledge, skills, and competencies required to excel in the rapidly evolving field of
                            computer science and engineering. The department aims to foster a conducive learning
                            environment that promotes critical thinking, problem-solving abilities, and creativity among
                            students. Additionally, it seeks to instill ethical values, professional integrity, and
                            social responsibility in future technologists.</p>
                        <h4>Academic Programs</h4>
                        <p>The CSE department offers a range of academic programs designed to cater to the diverse
                            interests and career aspirations of students. These programs include:</p>
                        <ul>
                            <li><b>Bachelor of Science (B.Sc.) </b>in Computer Science and Engineering</li>
                            <li><b>Master of Science (M.Sc.)</b> in Computer Science and Engineering</li>
                            <li><b>Diploma </b>in Computer Engineering</li>
                        </ul>
                        <p>These programs are structured to provide students with a comprehensive understanding of core
                            computer science principles, algorithms, data structures, software engineering
                            methodologies, and emerging technologies. The curriculum is regularly updated to align with
                            industry trends and global standards, ensuring that graduates are well-prepared for the
                            demands of the modern workforce.</p>
                        <h4>Faculty</h4>
                        <p>The strength of any academic department lies in its faculty, and the CSE department at NUBT
                            Khulna boasts a team of dedicated and highly qualified professors, researchers, and
                            instructors. The faculty members bring a wealth of academic expertise and industry
                            experience to the classroom, enriching the learning experience for students. They are
                            actively engaged in teaching, research, and professional development activities,
                            contributing to the advancement of knowledge in various domains of computer science and
                            engineering.</p>
                        <h4>Research Initiatives</h4>
                        <p>Research is an integral part of the academic culture at NUBT Khulna, and the CSE department
                            encourages both faculty and students to engage in innovative research projects that address
                            real-world challenges. Faculty members lead research initiatives in areas such as artificial
                            intelligence, machine learning, data science, cybersecurity, computer networks, and software
                            engineering. Through collaborative efforts with industry partners and other academic
                            institutions, the department aims to produce cutting-edge research outcomes that have a
                            positive impact on society.</p>
                        <h4>Community Contributions</h4>
                        <p>Beyond the confines of the university, the CSE department actively participates in outreach
                            programs, workshops, seminars, and conferences to share knowledge and expertise with the
                            broader community. It collaborates with local industries, government agencies, and
                            non-profit organizations to address societal needs and promote technological innovation.
                            Additionally, the department encourages students to engage in community service projects
                            that leverage their technical skills for the betterment of society.</p>
                        <h4>Conclusion</h4>
                        <p>In conclusion, the Computer Science and Engineering Department at the Northern University of
                            Business and Technology Khulna is a dynamic hub of learning, research, and innovation. With
                            its unwavering commitment to academic excellence, the department continues to nurture the
                            next generation of technology leaders who will drive positive change and innovation in
                            Bangladesh and beyond. Through its rigorous academic programs, world-class faculty,
                            groundbreaking research initiatives, and community contributions, the CSE department
                            exemplifies the university's dedication to advancing knowledge and fostering societal
                            development.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body bg-purple">
                        <h5 class="card-title text-white">Notices</h5>
                        <div class="notice-list">
                            @foreach ($latestNotices as $notice)
                                <ul>
                                    <a class="text-white" href="#" data-toggle="modal"
                                        data-target="#noticeModal_{{ $notice->id }}">
                                        {{ Str::words($notice->notice, 6, ' ..............') }}
                                    </a>
                                </ul>
                            @endforeach
                        </div>
                        <a class="text-white" href="/notices_s" class="see-more-notices">See More</a>
                    </div>
                </div>
                <br>

                <div class="card">
                    <div class="card-body bg-purple">
                        <h5 class="card-title text-white">Courses</h5>

                        <div class="course-list">
                            @foreach ($randomCourses as $course)
                                <ul>
                                    <a class="text-white" href="#" data-toggle="modal"
                                        data-target="#courseModal_{{ $course->id }}">
                                        {{ $course->c_title }}
                                    </a>
                                </ul>
                            @endforeach
                        </div>
                        <a class="text-white" href="{{ route('course.index_public') }}" class="see-more-courses">See
                            More</a>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body bg-purple">
                        <h5 class="card-title text-white">Teachers</h5>
                        <div class="teacher-list">
                            @foreach ($randomTeachers as $teacher)
                                <ul>
                                    <a class="text-white" href="#" data-toggle="modal"
                                        data-target="#teacherModal_{{ $teacher->id }}">{{ $teacher->t_name }}</a>
                                </ul>
                            @endforeach
                        </div>
                        <a class="text-white" href="{{ route('teacher.index_public') }}" class="see-more-teachers">See
                            More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notice Modal -->
    @foreach ($latestNotices as $notice)
        <div class="modal fade" id="noticeModal_{{ $notice->id }}" tabindex="-1" role="dialog"
            aria-labelledby="noticeModalLabel_{{ $notice->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="noticeModalLabel_{{ $notice->id }}">{{ $notice->created_at }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! nl2br(e($notice->notice)) !!} 
                        @if ($notice->attachment)
                            <p><br>Attachment: <a href="{{ url('uploads/notices/' . $notice->attachment) }}"
                                    target="_blank">Download</a></p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Course Modals -->
    @foreach ($randomCourses as $course)
        <div class="modal fade" id="courseModal_{{ $course->id }}" tabindex="-1" role="dialog"
            aria-labelledby="courseModalLabel_{{ $course->id }}" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="courseModalLabel_{{ $course->id }}">{{ $course->c_title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Course Code:</strong> {{ $course->c_code }}</p>
                        <p><strong>Section:</strong> {{ $course->c_section }}</p>
                        <p><strong>Semester:</strong> {{ $course->c_semester }}</p>
                        <p><strong>Teacher:</strong> {{ $course->t_name }}</p>
                        <div class="modal-body">
                            <div class="row justify-content-between">
                                <div class="col">
                                    @if($course->c_out)
                                        <a href="{{ asset('uploads/courses/' . $course->c_out) }}"
                                            class="btn btn-primary btn-sm">Download Outline</a>
                                    @else
                                        <span class="text-muted">Outline Not Available</span>
                                    @endif
                                </div>
                                <div class="col">
                                    @if($course->c_mat)
                                        <a href="{{ asset('uploads/courses/' . $course->c_mat) }}"
                                            class="btn btn-primary btn-sm">Download Material</a>
                                    @else
                                        <span class="text-muted">Material Not Available</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    <!-- Teacher Modals -->
    @foreach ($randomTeachers as $teacher)
        <div class="modal fade" id="teacherModal_{{ $teacher->id }}" tabindex="-1" role="dialog"
            aria-labelledby="teacherModalLabel_{{ $teacher->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="teacherModalLabel_{{ $teacher->id }}">{{ $teacher->t_name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ $teacher->t_image ? url('uploads/teachers/' . $teacher->t_image) : url('uploads/no-image.png') }}"
                                    class="card-img-top" alt="Teacher Image" style="width: 120px; height: auto;">
                            </div>
                            <div class="col-8">
                                <p><strong>Name:</strong> {{ $teacher->t_name }}</p>
                                <p><strong>Designation:</strong> {{ $teacher->t_des }}</p>
                                <p><strong>Email:</strong> <a
                                        href="mailto:{{ $teacher->t_email }}">{{ $teacher->t_email }}</a></p>
                                <p><strong>Phone:</strong> {{ $teacher->t_phone }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</body>
@include('footer')
</html>