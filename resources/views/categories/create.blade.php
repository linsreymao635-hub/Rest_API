@extends('categories.layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Add Categories</h5>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">Back</a>
        </div>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="e.g. Mobile">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-control @error('description') is-invalid @enderror"
                          rows="4"
                          placeholder="e.g. mobile description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <div class="form-check">
                    <input type="checkbox"
                           name="is_active"
                           id="is_active"
                           class="form-check-input"
                           {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Is Active</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
