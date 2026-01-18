@extends('layouts.admin.master')
@section('title', 'Invite Client')
@section('content')
    <main class="dashboard-wrapper">

        <h4 class="text-primary">Invite New Client</h4>

        <form action="{{ route('invite.company') }}" method="post">
            @csrf
            <div class="row mb-2">
                <div class="col-md-4">
                    <label for="name" class="px-1">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Client Name.....">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="email" class="px-1">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" id="email"
                        placeholder="ex. sam@gmail.com">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <input type="submit" value="Send Invitation" class="btn btn-primary">
        </form>

    </main>
@endsection
@section('scripts')
@endsection
