@extends('layout.main')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.index') }}"> Data User(Server
                                    Side)</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">Add Data</a>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title font-bold text-xl">List User Account</h3>

                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap" id="serverside">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Photo Profile</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            loadData();
        });

        function loadData() {
            $('#serverside').DataTable({

                processing: true,
                pagination: true,
                responsive: false,
                serverSide: true,
                searching: true,
                ordering: false,
                ajax: {
                    url: "{{ route('admin.serverside') }}",
                },
                columns: [{
                        data: 'no',
                        name: 'no',
                    },
                    {
                        data: 'photo',
                        name: 'photo',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ],
            });
        }
    </script>
@endsection
