
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Specialty</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.specialties.update', $specialty->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Specialty Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $specialty->name) }}"
                                required
                            >

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                id="description"
                                rows="4"
                                class="form-control @error('description') is-invalid @enderror"
                            >{{ old('description', $specialty->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update Specialty
                        </button>

                        <a href="{{ route('admin.specialties.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
