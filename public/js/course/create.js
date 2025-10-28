
$(document).ready(function () {
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
    $(document).on('click', '.addContent', function () {
        const moduleCard = $(this).closest('.card');
        const index = moduleCard.data('index');
        const contentsContainer = moduleCard.find('.contents-container');
        const contentIndex = contentsContainer.children().length;
        contentsContainer.append(createContentHtml(index, contentIndex));
    });

    // Remove Module
    $(document).on('click', '.removeModule', function () {
        if ($('.card[data-index]').length > 1) {
            $(this).closest('.card').remove();
        } else {
            alert("At least one module is required.");
        }
    });

    // Remove Content
    // Remove Content
    $(document).on('click', '.removeContent', function () {
        const moduleCard = $(this).closest('.card[data-index]');
        const contentsContainer = moduleCard.find('.contents-container');
        const contentCards = contentsContainer.children('.card');

        if (contentCards.length > 1) {
            $(this).closest('.card').remove();
        } else {
            alert("Each module must have at least one content.");
        }
    });


    // ✅ Fix “Invalid form control not focusable” issue
    $('#courseForm').on('submit', function (e) {
        const description = simplemde.value().trim();
        if (description === '') {
            e.preventDefault();
            alert('Please enter a course description.');
            return false;
        }
        $('#description').val(description);
    });
});