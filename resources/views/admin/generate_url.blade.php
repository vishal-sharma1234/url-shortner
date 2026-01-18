@extends('layouts.admin.master')
@section('title', 'Generate Url')
@section('content')
    <main class="dashboard-wrapper">

        <form action="{{ route('generate.url') }}" method="post">
            @csrf
            <div class="mb-2 ">
                <label for="url" class="px-1">Url <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="url" id="url"
                    placeholder="e.g. https://example.com/google-example">
                @error('url')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <input type="submit" value="submit" class="btn btn-primary">
        </form>

    </main>
@endsection
@section('scripts')
@endsection
