@php
$userRole = auth()->user()->role; // Récupérer le rôle de l'utilisateur actuel

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
    $layout = 'default';
    break;
}
@endphp

@extends($layout)
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white d-flex align-items-center justify-content-between">
            <div>
                <h3 class="mb-0">Create New Course</h3>
                <small class="opacity-8">Craft a compelling course to engage your audience</small>
            </div>
            <a href="{{ route('courses.userCourses') }}" class="btn btn-light btn-sm">
                <i class="material-icons align-middle" style="font-size:18px;">arrow_back</i>
                <span class="align-middle">My Courses</span>
            </a>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" id="create-course-form">
                @csrf
                <input type="hidden" name="coach_id" value="{{ auth()->user()->id }}">

                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body">
                                <div class="form-group mb-4">
                                    <label for="title" class="form-label">Course Title</label>
                                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="e.g., 4-Week Strength Training" value="{{ old('title') }}" required>
                                    <small class="form-text text-muted">Make it descriptive and engaging. Aim for 5–8 words.</small>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" rows="6" class="form-control @error('description') is-invalid @enderror" placeholder="Describe your course goals, audience, and outcomes" required>{{ old('description') }}</textarea>
                                    <small class="form-text text-muted">Tip: Include equipment needed and weekly schedule.</small>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-0">
                                    <label for="duration" class="form-label">Duration</label>
                                    <input type="text" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" placeholder="e.g., 4 weeks / 12 sessions" value="{{ old('duration') }}" required>
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body">
                                <label class="form-label d-flex align-items-center justify-content-between">
                                    Course Images
                                    <small class="text-muted">You can upload multiple images</small>
                                </label>

                                <div id="dropzone" class="dropzone-area d-flex align-items-center justify-content-center text-center">
                                    <div>
                                        <i class="material-icons mb-2" style="font-size:32px;opacity:.7">cloud_upload</i>
                                        <p class="mb-1">Drag & drop images here</p>
                                        <small class="text-muted">or click to browse</small>
                                    </div>
                                    <input type="file" id="picture" name="picture[]" class="file-input @error('picture.*') is-invalid @enderror" accept="image/*" multiple>
                                </div>
                                @error('picture.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                <div id="preview-grid" class="row mt-3 g-3">
                                    <!-- Previews injected here -->
                                </div>

                                <small class="form-text text-muted d-block mt-2">Supported: JPG, PNG, GIF. Max 2MB per image.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end mt-4">
                    <button type="submit" class="btn btn-success btn-lg px-4">
                        <i class="material-icons align-middle me-1" style="font-size:20px;">check_circle</i>
                        <span class="align-middle">Create Course</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%)}
    .dropzone-area{position:relative;border:2px dashed #ced4da;border-radius:.75rem;padding:2rem;background:#f8f9fa;cursor:pointer;transition:all .2s ease}
    .dropzone-area:hover{background:#f1f3f5}
    .dropzone-area.dragover{border-color:#764ba2;background:#eef2ff}
    .dropzone-area .file-input{position:absolute;inset:0;opacity:0;cursor:pointer}
    .preview-card{border-radius:.5rem;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,.08)}
    .preview-image{width:100%;height:140px;object-fit:cover}
    .preview-meta{font-size:.8rem;color:#6c757d}
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('picture');
    const previewGrid = document.getElementById('preview-grid');

    function createPreviewCard(file){
        const col = document.createElement('div');
        col.className = 'col-6';
        const card = document.createElement('div');
        card.className = 'preview-card';
        const img = document.createElement('img');
        img.className = 'preview-image';
        const reader = new FileReader();
        reader.onload = e => img.src = e.target.result;
        reader.readAsDataURL(file);
        const meta = document.createElement('div');
        meta.className = 'p-2 preview-meta';
        meta.textContent = file.name.length > 24 ? file.name.slice(0,21)+'...' : file.name;
        card.appendChild(img); card.appendChild(meta); col.appendChild(card);
        return col;
    }

    function handleFiles(files){
        [...files].forEach(file => {
            if(!file.type.startsWith('image/')) return;
            previewGrid.appendChild(createPreviewCard(file));
        });
    }

    dropzone.addEventListener('dragover', e => { e.preventDefault(); dropzone.classList.add('dragover'); });
    dropzone.addEventListener('dragleave', () => dropzone.classList.remove('dragover'));
    dropzone.addEventListener('drop', e => {
        e.preventDefault();
        dropzone.classList.remove('dragover');
        const dt = e.dataTransfer;
        if(dt && dt.files){
            handleFiles(dt.files);
            const dataTransfer = new DataTransfer();
            [...fileInput.files, ...dt.files].forEach(f => dataTransfer.items.add(f));
            fileInput.files = dataTransfer.files;
        }
    });

    fileInput.addEventListener('change', e => handleFiles(e.target.files));

    // Simple client-side required validation helper
    document.getElementById('create-course-form').addEventListener('submit', function(){
        const submitBtn = this.querySelector('button[type="submit"]');
        if(submitBtn){
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="material-icons align-middle me-1" style="font-size:20px;">hourglass_empty</i> Saving...';
        }
    });
});
</script>
@endsection
