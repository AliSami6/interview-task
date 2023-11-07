@extends('backend.layouts.master')

@section('title')
    MCQ - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection


@section('admin-content')

    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">MCQ</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>All MCQ</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->

    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left">MCQ List</h4>
                        <p class="float-right mb-2">
                            @if (Auth::guard('admin')->user()->can('question.create'))
                                <a class="btn btn-primary text-white"
                                    href="{{ route('admin/multiple_choice/create') }}">Create New Question</a>
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                           
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="10%">Sl</th>
                                        <th width="40%">Name</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($questions->isNotEmpty())
                                        @foreach ($questions as $ans)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $ans->name }}</td>

                                                <td class="d-flex" style="flex-wrap: wrap">
                                                    @if (Auth::guard('admin')->user()->can('question.view'))
                                                        <a class="btn btn-info text-white m-1"
                                                            href="{{ URL('admin/get-quiz', $ans->id) }}">Show</a>
                                                    @endif
                                                    @if (Auth::guard('admin')->user()->can('question.edit'))
                                                        <a class="btn btn-success text-white m-1"
                                                            href="{{ URL('admin/multiple_choice/edit', $ans->id) }}">Edit</a>
                                                    @endif

                                                    @if (Auth::guard('admin')->user()->can('question.delete'))
                                                        <form method="POST"
                                                            action="{{ route('admin/multiple_choice/delete', $ans->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger text-white m-1"
                                                                onclick="return confirm('Are you sure you want to delete this ?')">Delete</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection


@section('scripts')
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script>
        /*================================
            datatable active
            ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
    </script>
@endsection
