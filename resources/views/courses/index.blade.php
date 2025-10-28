@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">All Courses</h2>

        <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Create New Course</a>

        <div class="card shadow-none border">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-body p-3">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Feature Video</th>
                            <th>Modules & Contents</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $index => $course)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->category->name ?? '-' }}</td>
                                <td>
                                    @if ($course->feature_video)
                                        <video width="150" controls>
                                            <source src="{{ asset('storage/' . $course->feature_video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @foreach ($course->modules as $module)
                                        <strong>{{ $module->name }}</strong>
                                        <ul>
                                            @foreach ($module->contents as $content)
                                                <li>
                                                    {{ $content->title }}
                                                    @if ($content->link)
                                                        - <a href="{{ $content->link }}" target="_blank">Link</a>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </td>
                                <td>{{ $course->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No courses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
