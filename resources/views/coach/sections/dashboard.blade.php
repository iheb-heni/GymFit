@extends('coach.dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary shadow-lg border-0">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="text-white mb-2">Welcome back, {{ $user->civility }} {{ $user->name }}!</h2>
                            <p class="text-white opacity-8 mb-0">Ready to inspire and motivate your fitness community today?</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="avatar avatar-xl position-relative">
                                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/defaultimage.jpg') }}" 
                                     alt="Profile" class="w-100 border-radius-lg shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">class</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Courses</p>
                        <h4 class="mb-0">{{ $user->createdCourses()->count() }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+{{ $user->createdCourses()->whereMonth('created_at', now()->month)->count() }}</span> this month</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">notes</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Posts</p>
                        <h4 class="mb-0">{{ $user->posts()->count() }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-info text-sm font-weight-bolder">+{{ $user->posts()->whereMonth('created_at', now()->month)->count() }}</span> this month</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">people</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Followers</p>
                        <h4 class="mb-0">{{ $user->followers()->count() }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-warning text-sm font-weight-bolder">+{{ $user->followers()->whereMonth('follows.created_at', now()->month)->count() }}</span> this month</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">comment</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Comments</p>
                        <h4 class="mb-0">{{ $user->posts()->withCount('comments')->get()->sum('comments_count') }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">+{{ $user->posts()->whereHas('comments', function($q) { $q->whereMonth('created_at', now()->month); })->count() }}</span> this month</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Quick Actions</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('startcourse') }}" class="btn btn-outline-primary btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="material-icons me-2">add_circle</i>
                                Create Course
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('createpost') }}" class="btn btn-outline-info btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="material-icons me-2">add_box</i>
                                Create Post
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('courses.userCourses') }}" class="btn btn-outline-success btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="material-icons me-2">class</i>
                                Manage Courses
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('posts.userPosts') }}" class="btn btn-outline-warning btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="material-icons me-2">notes</i>
                                Manage Posts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Recent Posts</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-check text-info" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">Your latest content</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Post</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Comments</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($user->posts()->latest()->take(5)->get() as $post)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ $post->post_pics ? asset('storage/posts/' . json_decode($post->post_pics)[0]) : asset('images/defaultimage.jpg') }}" 
                                                     class="avatar avatar-sm me-3 border-radius-lg" alt="post image">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ Str::limit($post->content, 50) }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $post->comments()->count() }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">{{ $post->created_at->format('M d, Y') }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('viewpost', $post->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View post">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <p class="text-muted">No posts yet. <a href="{{ route('createpost') }}">Create your first post!</a></p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Your Courses</h6>
                </div>
                <div class="card-body p-3">
                    @forelse($user->createdCourses()->latest()->take(4)->get() as $course)
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-icons text-success text-gradient">class</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $course->title }}</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ Str::limit($course->description, 60) }}</p>
                                <p class="text-xs text-muted mb-0">{{ $course->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="material-icons text-muted" style="font-size: 3rem;">class</i>
                        <p class="text-muted mt-2">No courses yet. <a href="{{ route('startcourse') }}">Create your first course!</a></p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Insights -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Performance Insights</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm icon-shape-success rounded me-3">
                                    <i class="material-icons text-success">trending_up</i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Engagement Rate</h6>
                                    <p class="text-sm text-muted mb-0">Based on comments and interactions</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm icon-shape-info rounded me-3">
                                    <i class="material-icons text-info">visibility</i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Content Reach</h6>
                                    <p class="text-sm text-muted mb-0">Your posts are reaching {{ $user->followers()->count() }} followers</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm icon-shape-warning rounded me-3">
                                    <i class="material-icons text-warning">schedule</i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Activity Level</h6>
                                    <p class="text-sm text-muted mb-0">{{ $user->posts()->whereMonth('created_at', now()->month)->count() }} posts this month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
