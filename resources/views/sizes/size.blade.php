@extends('layouts.master')
@section('content')
    <!-- BEGIN: Subheader -->
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    Product's size
                                </h3>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <!--begin::Form-->
                    <form class="m-form" name="color-form" method="POST" action="{{route('size')}}">
                        {{ csrf_field() }}
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <input type="hidden" name="id" value="{{$size->id or ''}}">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Name:
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" name="name" class="form-control m-input" value="{{$size->name or ''}}"
                                               placeholder="Enter size name">
                                        <span class="m-form__help">
															Please enter your size name
														</span>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="submit" class="btn btn-success">
                                            Submit
                                        </button>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="reset" class="btn btn-secondary">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div style="float: left" class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Sizes List
                                </h3>
                            </div>
                            <div style="float: right;padding-top: 1%;">
                                <a class="btn btn-primary" href="{{route('add-product')}}">Add New Product</a>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Section-->
                        <div class="m-section">
                            <div class="m-section__content">
                                <table class="table m-table m-table--head-bg-success">
                                    <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                             Name
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Created
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sizes as $row)
                                    <tr>
                                        <th scope="row">
                                            {{$row->id}}
                                        </th>
                                        <td>
                                            {{$row->name}}
                                        </td>
                                        <td>
                                            {{$row->status}}
                                        </td>
                                        <td>
                                            {{$row->created_at}}
                                        </td>
                                        <td>
                                            <a href="{{url('/size',$row->id)}}">Edit</a>|
                                            <a href="{{url('/size-delete',$row->id)}}">Delete</a>
                                        </td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>

@endsection