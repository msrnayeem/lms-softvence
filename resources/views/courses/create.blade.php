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

    <script>
        $(document).ready(function() {
            // ✅ Initialize SimpleMDE
            const simplemde = new SimpleMDE({
                element: document.getElementById("description"),
                spellChecker: false,
                placeholder: "Write a detailed course description..."
            });

            let moduleIndex = 0;

            // ✅ Generate Content Block
            function createContentHtml(moduleIdx, contentIdx) {
                return `
<div class="card mb-3 border-secondary-subtle">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Content Title</label>
                <input type="text" class="form-control" 
                       name="modules[${moduleIdx}][contents][${contentIdx}][title]" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Content Type</label>
                <select class="form-select" 
                        name="modules[${moduleIdx}][contents][${contentIdx}][source_type]" required>
                    <option value="link" selected>Link (YouTube)</option>
                </select>
            </div>
        </div>

        <div class="mt-3">
            <label class="form-label">YouTube Link</label>
            <input type="url" class="form-control" 
                   name="modules[${moduleIdx}][contents][${contentIdx}][link]" 
                   placeholder="https://www.youtube.com/watch?v=..." required>
        </div>

        <div class="text-end mt-3">
            <button type="button" class="btn btn-outline-danger btn-sm removeContent">
                <i class="bi bi-trash me-1"></i> Remove Content
            </button>
        </div>
    </div>
</div>`;
            }

            // ✅ Generate Module Block
            function createModuleHtml(moduleIdx) {
                return `
<div class="card mb-4 border-primary-subtle" data-index="${moduleIdx}">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Module ${moduleIdx + 1}</h5>
        <button type="button" class="btn btn-outline-danger btn-sm removeModule">
            <i class="bi bi-x-circle me-1"></i> Remove Module
        </button>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Module Name</label>
            <input type="text" class="form-control" 
                   name="modules[${moduleIdx}][name]" required>
        </div>

        <div class="contents-container"></div>

        <div class="text-end">
            <button type="button" class="btn btn-outline-success btn-sm addContent">
                <i class="bi bi-plus-circle me-1"></i> Add Content
            </button>
        </div>
    </div>
</div>`;
            }

            // ✅ Add New Module
            function addModule() {
                const moduleHtml = createModuleHtml(moduleIndex);
                $('#modulesContainer').append(moduleHtml);

                const contentsContainer =
                    $(`#modulesContainer .card[data-index="${moduleIndex}"] .contents-container`);
                contentsContainer.append(createContentHtml(moduleIndex, 0));

                moduleIndex++;
            }

            // ✅ Add First Default Module
            addModule();

            // Add Module
            $('#addModule').click(() => addModule());

            // Add Content to Module
            $(document).on('click', '.addContent', function() {
                const moduleCard = $(this).closest('.card');
                const index = moduleCard.data('index');
                const contentsContainer = moduleCard.find('.contents-container');
                const contentIndex = contentsContainer.children().length;
                contentsContainer.append(createContentHtml(index, contentIndex));
            });

            // Remove Module
            $(document).on('click', '.removeModule', function() {
                if ($('.card[data-index]').length > 1) {
                    $(this).closest('.card').remove();
                } else {
                    alert("At least one module is required.");
                }
            });

            // Remove Content
            $(document).on('click', '.removeContent', function() {
                const moduleBody = $(this).closest('.card-body');
                const contents = moduleBody.find('.card');
                if ($(this).closest('.card-body').find('.card').length > 1) {
                    $(this).closest('.card').remove();
                } else {
                    alert("Each module must have at least one content.");
                }
            });

            // ✅ Fix “Invalid form control not focusable” issue
            $('#courseForm').on('submit', function(e) {
                const description = simplemde.value().trim();
                if (description === '') {
                    e.preventDefault();
                    alert('Please enter a course description.');
                    return false;
                }
                $('#description').val(description);
            });
        });
    </script>
@endpush
