@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h3 class="fw-bold mb-4">Create New Course</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There were some problems with your input:</strong>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="courseForm" action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Course Title --}}
            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">Course Title</label>
                <input type="text" class="form-control" name="title" id="title" required maxlength="150">
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Course Description</label>
                <textarea class="form-control" name="description" id="description" rows="6"></textarea>
            </div>

            {{-- Category & Feature Video --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="category_id" class="form-label fw-semibold">Category</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="feature_video" class="form-label fw-semibold">Feature Video</label>
                    <input type="file" class="form-control" name="feature_video" id="feature_video" accept="video/*">
                </div>
            </div>

            <hr class="my-4">

            {{-- Modules Section --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0">Modules</h4>
                <button type="button" id="addModule" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Add Module
                </button>
            </div>

            <div id="modulesContainer"></div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success btn-lg px-4">
                    <i class="bi bi-check2-circle me-1"></i> Create Course
                </button>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="{{ asset('js/course/create.js') }}"></script>
@endpush
