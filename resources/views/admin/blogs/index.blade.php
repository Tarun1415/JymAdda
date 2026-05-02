@extends('admin.layouts.app')

@push('css')
<style>
    .status-select {
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 4px 30px 4px 12px;
        border: 1px solid #cbd5e1;
        cursor: pointer;
        transition: all 0.2s;
    }
    .status-select:focus {
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        border-color: #4f46e5;
    }
    .status-draft { background-color: #f1f5f9; color: #475569; }
    .status-published { background-color: #dcfce7; color: #166534; border-color: #bbf7d0; }
</style>
@endpush

@section('content')
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="page-header-title">
          <h2 class="mb-0">Gymhai Blogs</h2>
        </div>
      </div>
      <div class="col-md-6 text-md-end mt-3 mt-md-0">
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary"><i class="ti ti-plus me-1"></i> Add New Blog</a>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif
        
        <div class="card bg-white border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-light text-uppercase font-monospace text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                            <tr>
                                <th>Image</th>
                                <th>Title & Slug</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blogs as $blog)
                            <tr>
                                <td>
                                    @if($blog->featured_image)
                                        <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" class="img-radius" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="img-radius" style="width: 50px; height: 50px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                                            <i class="ti ti-photo text-muted fs-4"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong class="d-block text-truncate" style="max-width: 300px;">{{ $blog->title }}</strong>
                                    <small class="text-muted"><i class="ti ti-link"></i> {{ $blog->slug }}</small>
                                </td>
                                <td>
                                    <form action="{{ route('admin.blogs.status', $blog) }}" method="POST" class="status-form m-0">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm status-select {{ $blog->status === 'published' ? 'status-published' : 'status-draft' }}" onchange="this.form.submit()">
                                            <option value="draft" {{ $blog->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ $blog->status === 'published' ? 'selected' : '' }}>Published</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><i class="ti ti-eye"></i> {{ $blog->views }}</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-medium fs-6">{{ $blog->created_at->format('M d, Y') }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit Blog">
                                            <i class="ti ti-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                        @if($blog->status === 'published')
                                            <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip" title="View in Frontend">
                                                <i class="ti ti-external-link"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="ti ti-article opacity-50 mb-2" style="font-size: 3rem;"></i>
                                        <h5 class="mt-2">No Blogs Found</h5>
                                        <p>Get started by creating your first blog post!</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($blogs->hasPages())
            <div class="card-footer bg-white pt-4">
                {{ $blogs->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
