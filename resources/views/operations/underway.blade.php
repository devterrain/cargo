@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    @section('title')
        عمليات الشحن قيد التنفيذ
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

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">م</th>
                                <th class="wd-5p border-bottom-0">كود العملية</th>
                                <th class="wd-10p border-bottom-0">رقم السيارة</th>
                                <th class="wd-10p border-bottom-0">سير</th>
                                <th class="wd-10p border-bottom-0">عنبر</th>
                                <th class="wd-15p border-bottom-0">اسم السائق</th>
                                <th class="wd-15p border-bottom-0">ملاحظات</th>
                                <th class="wd-10p border-bottom-0">الإعدادات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach($shippings as $shipping)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$shipping->id}}</td>
                                    <td>{{$shipping->vehicle->plate_num}}</td>
                                    <td>سير رقم {{$shipping->convair->convair_num}}</td>
                                    <td>عنبر رقم {{$shipping->gate_num}}</td>
                                    <td>{{$shipping->operatortwo->operator_name}}</td>
                                    <td>{{$shipping->shipping_notes}}</td>
                                    <td>
                                        <a class="modal-effect btn btn-info" data-effect="effect-scale"
                                           data-id="{{ $shipping->id }}"
                                           data-operator2_id="{{$shipping->shipping_notes}}"
                                           data-toggle="modal" href="#modaldemo8" title="إنهاء عملية الشحن"><i
                                                class="fas fa-hourglass-end"></i></a>

                                        <a class="modal-effect btn btn-danger" data-effect="effect-scale"
                                           data-id="{{ $shipping->id }}"
                                           data-operator2_id="{{$shipping->operator2_id}}"
                                           data-toggle="modal" href="#modaldemo9" title="إلغاء العملية"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- edit -->
        <div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">عمليات الشحن قيد التنفيذ</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="underway/update" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="text">رقم القلاب</label>
                                <input class="form-control form-control-lg" id="vehicle_id" name="vehicle_id"
                                       value="{{$shipping->vehicle->plate_num}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="text">ملاحظات</label>
                                <textarea name="shipping_notes" id="shipping_notes"
                                          class="form-control form-control-lg"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"> تأكيد إنهاء عملية الشحن</button>
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
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <script>
        $('#modaldemo8').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id')
            let shipping_notes = button.data('shipping_notes')
            let modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #shipping_notes').val(shipping_notes);
        })
    </script>

@endsection
