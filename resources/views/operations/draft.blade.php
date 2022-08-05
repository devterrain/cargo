@extends('layouts.master')
@section('css')

    @section('title')
        إعداد الدرافت
    @stop

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عمليات الشحن قيد التنفيذ</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- row -->
    <!-- row -->
    <div class="row">

        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-outline-success btn-lg" data-effect="effect-scale"
                           data-toggle="modal" href="#modaldemo8"> إعداد الدرافت <i class="fas fa-ship"></i> </a>
                    </div>
                    <br><br><br><br><br>
                </div>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
    <!-- edit -->
    <div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">إعداد الدرافت</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="draft/update" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="ship_trip_id" id="ship_trip_id" value="">
                            <label for="text">كمية الدرافت</label>
                            <input class="form-control form-control-lg" type="text" name="weight" id="weight">
                        </div>
                        <div class="form-group">
                            <label for="text">رحلة السفينة</label>
                            <select name="ship_trip_id" id="ship_trip_id" class="form-control form-control-lg">
                                <option disable selected>--حدد رحلة السفينة--</option>
                                @foreach($shiptrips as $shiptrip)
                                    <option value="{{ $shiptrip->id}}">{{ $shiptrip->arrival_date}}
                                        - {{ $shiptrip->ship->ship_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">من</label>
                            <input type="datetime-local" id="start_at" name="start_at"
                            class="form-control form-control-lg" min="2018-06-07T00:00">
                        </div>
                        <div class="form-group">
                            <label for="text">إلى</label>
                            <input type="datetime-local" id="end_at" name="end_at"
                            class="form-control form-control-lg" min="2018-06-07T00:00">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"> تأكيد الدرافت</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- main-content closed -->
@endsection

