@php
    $userRole = auth()->user()->role; // Get the current user's role

    switch ($userRole) {
        case 'admin':
            $layout = 'admin.dashboard';
            break;
        case 'coach':
            $layout = 'coach.dashboard';
            break;
        case 'user':
            $layout = 'user.dashboard';
            break;
        default:
            $layout = 'default'; // Fallback layout
            break;
    }
@endphp

@extends($layout)
@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{$coach->couverture_pic  ? asset('storage/' . $coach->couverture_pic) : asset('images/defaultimage.jpg') }}');">
        <span class="mask  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ $coach->profile_photo ? asset('storage/' . $coach->profile_photo) : asset('images/defaultimage.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $coach->name }} {{ $coach->secondname }}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        {{ $coach->occupation ?? 'no occupation' }}
                    </p>
                </div>
            </div>
            <div class="col-auto my-auto">

              <!-- Follow/Unfollow Buttons -->
              @if(auth()->check() && auth()->user()->id !== $coach->id)
              @php
                  $isFollowing = auth()->user()->followers->contains($coach->id);
              @endphp
              <div class="col-12 mt-4">
                  @if($isFollowing)
                      <form action="{{ route('unfollow', $coach->id) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-danger">Unfollow</button>
                      </form>
                      <p class="text-success mt-2">Already following this coach.</p>
                  @else
                      <form action="{{ route('follow', $coach->id) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-primary">Follow</button>
                      </form>
                  @endif
              </div>
          @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Profile Information</h6>
                    </div>

                    <div class="card-body p-3">
                        <p class="text-sm">
                            {{ $coach->activity_description }}
                        </p>
                        <hr class="horizontal gray-light my-4">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{ $coach->name }} {{ $coach->secondname }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; {{ $coach->phone }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ $coach->email }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm">
                                <strong class="text-dark">Location:</strong> &nbsp;
                                @if ($coach->city && $coach->country)
                                    {{ $coach->city }}, {{ $coach->country }}
                                @elseif ($coach->city)
                                    {{ $coach->city }}
                                @elseif ($coach->country)
                                    {{ $coach->country }}
                                @else
                                    No location provided
                                @endif
                            </li>
                            <li class="list-group-item border-0 ps-0 pb-0">
                                <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                @if($coach->facebook || $coach->twitter || $coach->instagram || $coach->linkedin)
                                    @if($coach->facebook)
                                        <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="{{ $coach->facebook }}" target="_blank" rel="noopener noreferrer">
                                            <i class="fab fa-facebook fa-lg"></i>
                                        </a>
                                    @endif
                                    @if($coach->twitter)
                                        <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="{{ $coach->twitter }}" target="_blank" rel="noopener noreferrer">
                                            <i class="fab fa-twitter fa-lg"></i>
                                        </a>
                                    @endif
                                    @if($coach->instagram)
                                        <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="{{ $coach->instagram }}" target="_blank" rel="noopener noreferrer">
                                            <i class="fab fa-instagram fa-lg"></i>
                                        </a>
                                    @endif
                                    @if($coach->linkedin)
                                        <a class="btn btn-linkedin btn-simple mb-0 ps-1 pe-2 py-0" href="{{ $coach->linkedin }}" target="_blank" rel="noopener noreferrer">
                                            <i class="fab fa-linkedin fa-lg"></i>
                                        </a>
                                    @endif
                                @else
                                    No social media provided
                                @endif
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Following: {{ $coach->followings->count() }}</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @foreach ($coach->followings as $followedcoach)
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                    <div class="avatar me-3">
                                        <a href="{{ $followedcoach->role === 'coach' ? route('coachs.show', $followedcoach->id) : route('users.show', $followedcoach->id) }}">
                                            <img src="{{ $followedcoach->profile_photo ? asset('storage/' . $followedcoach->profile_photo) : asset('images/defaultimage.jpg') }}"
                                                alt="coach" class="border-radius-lg shadow">
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <a href="{{ $followedcoach->role === 'coach' ? route('coachs.show', $followedcoach->id) : route('users.show', $followedcoach->id) }}" class="text-decoration-none">
                                            <h6 class="mb-0 text-sm">{{ $followedcoach->name }} {{ $followedcoach->secondname }}</h6>
                                        </a>
                                        <p class="mb-0 text-xs">{{ $followedcoach->role }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Followers : {{ $coach->followers->count() }}</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @foreach ($coach->followers as $follower)
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                    <div class="avatar me-3">
                                        <a href="{{ $follower->role === 'coach' ? route('coachs.show', $follower->id) : route('users.show', $follower->id) }}">
                                            <img src="{{ $follower->profile_photo ? asset('storage/' . $follower->profile_photo) : asset('images/defaultimage.jpg') }}"
                                                alt="coach" class="border-radius-lg shadow">
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <a href="{{ $follower->role === 'coach' ? route('coachs.show', $follower->id) : route('users.show', $follower->id) }}" class="text-decoration-none">
                                            <h6 class="mb-0 text-sm">{{ $follower->name }} {{ $follower->secondname }}</h6>
                                        </a>
                                        <p class="mb-0 text-xs">{{ $follower->role }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Enrolled Courses -->
            <div class="col-12 col-xl-6">
                <div class="mb-5 ps-3">
                    <h6 class="mb-1">Enrolled Courses</h6>
                    <p class="text-sm">Courses the coach is teaching.</p>
                </div>
                <div class="row">
                    @forelse($coach->createdCourses as $course)
                        <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-plain h-100">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-1">
                                    <a href="{{ route('viewcourse', $course->id) }}">
                                        @if ($course->picture)
                                            <img src="{{ asset('storage/' . $course->picture) }}" alt="Course Image"
                                                class="img-fluid border-radius-lg">
                                        @else
                                            <img src="{{ asset('images/defaultimage.jpg') }}" alt="Default Course Image"
                                                class="img-fluid border-radius-lg">
                                        @endif
                                    </a>
                                </div>
                                <div class="card-body p-3">
                                    <a href="{{ route('viewcourse', $course->id) }}" class="text-decoration-none">
                                        <h5>{{ $course->title }}</h5>
                                    </a>
                                    <p class="mb-0">{{ $course->description }}</p>
                                    <a class="btn btn-primary" href="{{ route('viewcourse', $course->id) }}">
                                        viewcourse
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No courses available</p>
                    @endforelse
                </div>
            </div>

            <!-- Posts -->
            <div class="col-12 col-xl-6">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Posts: {{ $coach->posts->count() }}</h6>
                        @if ($coach->posts->isEmpty())
                            <h6 class="mt-3 text-center">No posts available </h6>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            @foreach ($coach->posts as $post)
                                <div class="col-md-12 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $post->created_at ? $post->created_at->format('F j, Y, g:i a') : 'Date not available' }}
                                            </h5>
                                            <p class="card-text">{{ $post->content }}</p>
                                            <a href="{{-- route('viewpost', $post->id) --}}" class="btn btn-primary">View Post</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
