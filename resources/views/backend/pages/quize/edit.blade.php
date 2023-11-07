@extends('backend.layouts.master')

@section('title')
    Quize Edit - Admin Panel
@endsection

@section('styles')
    <style>

    </style>
@endsection


@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">MCQ Edit</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin/multiple_choice/index') }}">All MCQ</a></li>
                        <li><span>Edit MCQ</span></li>
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
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" />
                        <div id="fb-editor"></div>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ URL::asset('backend/assets/form-builder/form-builder.min.js') }}"></script>
    <script>
        var fbEditor = document.getElementById('fb-editor');
        var formBuilder = $(fbEditor).formBuilder({
            onSave: function(evt, formData) {
                saveForm(formData);
            },
        });

        $(function() {
            $.ajax({
                type: 'get',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                url: '{{ URL('admin/multiple_choice/edit') }}',
                data: {
                    'id': '{{ $id }}'
                },
                success: function(data) {

                    $("#name").val(data.name);
                    formBuilder.actions.setData(data.content);
                }
            });
        });

        function saveForm(form) {
            $.ajax({
                type: 'post',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                url: '{{ URL('admin/multiple_choice/update') }}',
                data: {
                    'form': form,
                    'name': $("#name").val(),
                    'id': {{ $id }},
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    if (data.status == 'success') {
                        console.log(data);
                        flashMessage(data.status, data.message)
                    } else {
                        flashMessage(data.status, data.message)
                    }

                }

            });


        }
    </script>
@endsection
