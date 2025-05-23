@extends('admin.layouts.app')

@section('title', 'Edit Rumah')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-house-gear me-2"></i>Edit Rumah</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Seller --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Pemilik (Seller)</label>
                    <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                        @foreach($sellers as $seller)
                            <option value="{{ $seller->id }}" {{ old('user_id', $property->user_id) == $seller->id ? 'selected' : '' }}>
                                {{ $seller->name }} ({{ $seller->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $property->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Harga --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                           value="{{ old('price', $property->price) }}" required step="1" min="0">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                              rows="5">{{ old('description', $property->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                           value="{{ old('address', $property->address) }}" required>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Gambar --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Foto Rumah</label><br>
                    @if($property->image)
                        <img src="{{ asset('storage/' . $property->image) }}" class="img-thumbnail mb-2" style="height: 150px;">
                    @endif
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="available" {{ old('status', $property->status) == 'available' ? 'selected' : '' }}>
                            Tersedia
                        </option>
                        <option value="sold" {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>
                            Terjual
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Perbarui
                    </button>
                    <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
