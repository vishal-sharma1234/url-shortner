@extends('layouts.admin.master')
@section('title' , 'Dashboard')
@section('content')
    <main class="dashboard-wrapper">
        @if (auth()->user()->hasRole('SuperAdmin'))
            <div class="table-responsive">
                <div class="d-flex justify-content-between align-items-center text-center mb-3">
                    <h4 class="text-primary">
                        Clients
                    </h4>
                    <a href="{{ route('invite.company') }}" class="btn btn-sm text-sm btn-primary text-decoration-none">
                        Invite
                    </a>
                </div>
                <table class="company-datatable-basic table table-bordered align-middle">
                    <thead>
                    </thead>
                </table>
            </div>
        @endif

        <div class="table-responsive mt-5">
            <div class="d-flex gap-3 align-items-center text-center mb-3">
                <h4 class="text-primary">
                    Generated Short Urls
                </h4>

                @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Member'))
                    <a href="{{ route('generate.url') }}" class="btn btn-sm text-sm btn-primary text-decoration-none">
                        Generate
                    </a>
                @endif
            </div>
            <table class="url-datatable-basic table table-bordered align-middle">
                <thead>
                </thead>
            </table>
        </div>

        @if (auth()->user()->hasRole('Admin'))
            <div class="table-responsive mt-5">
                <div class="d-flex justify-content-between align-items-center text-center mb-3">
                    <h4 class="text-primary">
                        Team Members
                    </h4>
                    @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Member'))
                        <a href="{{ route('invite.member') }}" class="btn btn-sm text-sm btn-primary text-decoration-none">
                            Invite
                        </a>
                    @endif
                </div>
                <table class="members-datatable-basic table table-bordered align-middle">
                    <thead>
                    </thead>
                </table>
            </div>
        @endif

    </main>
@endsection
@section('scripts')
    <script>
        $(function() {

            let datatableButtons = [{
                extend: "collection",
                className: "btn btn-primary dropdown-toggle me-4 waves-effect waves-light border-none",
                text: '<i class="ti ti-file-export ti-xs me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                buttons: [
                    {
                        extend: "pdf",
                        text: '<i class="ti ti-file-description me-1"></i>Download',
                        className: "dropdown-item",
                    }
                ]
            }];

            $(".company-datatable-basic").DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [10, 25, 50, 75, 100],
                dom: 'Bfrtip',
                buttons: datatableButtons,
                ajax: "{{ route('companies.index') }}",
                columns: [{
                        data: 'name',
                        title: 'Client Name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        title: 'Email'
                    },
                    {
                        data: 'users',
                        name: 'users',
                        title: 'Users'
                    },
                    {
                        data: 'total_genrated_url',
                        name: 'total_genrated_url',
                        title: 'Total Genrated Url'
                    },
                    {
                        data: 'hits',
                        name: 'hits',
                        title: 'Total Url Hits'
                    },
                ]
            });

            $(".url-datatable-basic").DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [10, 25, 50, 75, 100],
                dom: 'Bfrtip',
                buttons: datatableButtons,
                ajax: "{{ route('urls.index') }}",
                columns: [
                    {
                        data: 'original_url',
                        name: 'original_url',
                        title: 'Original Url'
                    },
                    {
                        data: 'url',
                        name: 'url',
                        title: 'Short Url'
                    },
                    {
                        data: 'hits',
                        name: 'hits',
                        title: 'Hits'
                    },
                    @if (auth()->user()->hasRole('SuperAdmin'))
                        {
                            data: 'company_invitation_id',
                            name: 'company_invitation_id',
                            title: 'Client'
                        },
                    @endif
                    @if (auth()->user()->hasRole('Admin'))
                        {
                            data: 'user_id',
                            name: 'user_id',
                            title: 'Generated By'
                        },
                    @endif {
                        data: 'created_at',
                        name: 'created_at',
                        title: 'Created On'
                    },
                ]
            });

            $(".members-datatable-basic").DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrtip',
                buttons: datatableButtons,
                ajax: "{{ route('members.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name',
                        title: 'Name'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        title: 'Email'
                    },
                    {
                        data: 'role',
                        name: 'role',
                        title: 'Role'
                    },
                    {
                        data: 'total_genrated_url',
                        name: 'total_genrated_url',
                        title: 'Total Genrated Url'
                    },
                    {
                        data: 'hits',
                        name: 'hits',
                        title: 'Total Url Hits'
                    },


                ]
            });
        });
    </script>
@endsection
