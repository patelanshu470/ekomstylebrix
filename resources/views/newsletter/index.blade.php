@extends('backend.layouts.admin_master')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/cust_backend/coupon/coupon.css') }}">
    <style>
        .table th {
            font-size: 14px !important;
        }
        .tox-notifications-container {
            display: none;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All Subscriber</h5>
                            <form class="d-inline-flex">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModalToggle2"
                                    class="align-items-center btn btn-theme d-flex">
                                    <i data-feather="plus-square"></i>Create
                                </a>
                            </form>
                        </div>
                        <div class="table-responsive category-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $key => $data)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $data->email }}</td>

                                                @if ($data->status == '1')
                                                    <td style="color:green;">Subscribed</td>
                                                @else
                                                    <td style="color:red;">UnSubscribed</td>
                                                @endif

                                            </tr>
                                            <!-- Delete Modal Box Start -->
                                            <div class="modal fade theme-modal remove-coupon"
                                                id="deleteModel{{ $data->id }}" aria-hidden="true" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-block text-center">
                                                            <h5 class="modal-title w-100" id="exampleModalLabel22">Are You
                                                                Sure ?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="remove-box">
                                                                <p>Are you sure,you want to delete this record?</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-animation btn-md fw-bold"
                                                                data-bs-dismiss="modal">No</button>
                                                            <a href="{{ route('coupon.delete', $data->id) }}"
                                                                class="btn btn-animation btn-md fw-bold">Yes</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- add model  --}}
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Email Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form"
                    id="banner4formAdd" action="{{ route('send.news.email') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Subject</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="subject" type="text"
                                        placeholder="Email subject/heading">
                                </div>
                            </div>
                            <label class="form-label-title col-sm-3 mb-0">Body</label>
                            <div class="mb-4 row " style="justify-content: center">
                                <div class="form-group col-sm-12 col-12">
                                    <div class="col-sm-12">
                                        <textarea id="tiny" name="body"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit_btn" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>

    <script>
        $('textarea#tiny').tinymce({
            height: 300,
            Width: 300,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | removeformat | help'
        });
    </script>

<script>
$('#banner4formAdd').validate({
    rules: {
        subject: {
            required: true,
        },
        body: {
            required: true,
        },
    },
    messages: {
        subject: {
            required: "Email subject is required",
        },
        body: {
            required: "Email heading is required",
        },
    },
});
</script>

@endsection
