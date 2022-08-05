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
        عمليات الشحن
    @stop

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عمليات شحن البضائع</span>
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
                        <h4>عمليات الشحن قيد التنفيذ</h4>
                    </div>
                    <div class="d-flex justify-content-between">

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">كود العملية</th>
                                <th class="wd-15p border-bottom-0">رقم السيارة</th>
                                <th class="wd-15p border-bottom-0">رقم المخزن</th>
                                <th class="wd-15p border-bottom-0">السفينة</th>
                                <th class="wd-10p border-bottom-0">اسم السائق</th>
                                <th class="wd-10p border-bottom-0">وقت الخروج من المخزن</th>
                                <th class="wd-10p border-bottom-0">الإعدادات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach($shippings as $shipping)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$shipping->vehicle->plate_num}}</td>
                                    <td>{{$shipping->store->store_name}}</td>
                                    <td>{{ $shipping->shiptrip->arrival_date}} - {{ $shipping->shiptrip->ship->ship_name}}</td>
                                    <td>{{$shipping->operator->operator_name}}</td>
                                    <td>{{$shipping->load_end}}</td>
                                    <td>
                                        <a class="modal-effect btn btn-info" data-effect="effect-scale"
                                           data-id="{{ $shipping->id }}"
                                           data-operator2_id="{{$shipping->operator2_id}}"
                                           data-toggle="modal" href="#modaldemo8" title="بدء عملية الشحن"><i
                                                class="fas fa-hourglass-start"></i></a>

                                        <a class="modal-effect btn btn-danger" data-effect="effect-scale"
                                           data-id="{{ $shipping->id }}"
                                           data-vehicle_id="{{$shipping->vehicle->plate_num}}"
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
                        <form action="shipping/update" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="text" class="text-primary">الوردية</label>
                                <select name="end_shift" id="end_shift" class="form-control form-control-lg">
                                    <option disable selected>حدد الوردية</option>
                                    <option value="1" {{ old('start_shift') == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('start_shift') == 2 ? 'selected' : '' }}>2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="text" class="text-secondary">رقم السير</label>
                                <select name="convair_id" id="convair_id" class="form-control form-control-lg">
                                    <option disable selected>حدد رقم سير الرفع</option>
                                    @foreach($convairs as $convair)
                                        <option value="{{ $convair->id}}"> سير رقم {{ $convair->convair_num}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary">رقم العنبر</label>
                                <select name="gate_num" id="gate_num" class="form-control form-control-lg">
                                    <option disable selected>حدد رقم العنبر</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary">حدد سائق القلاب</label>
                                <select name="operator2_id" id="operator2_id" class="form-control form-control-lg" required>
                                    <option disable selected>سائق القلاب</option>
                                    @foreach($operators as $operator)
                                        <option value="{{ $operator->id}}">{{ $operator->operator_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">ملاحظات</label>
                                <textarea name="shipping_notes" id="shipping_notes"
                                          class="form-control form-control-lg"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"> تأكيد بدء عملية الشحن</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">إلغاء عملية الشحن</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                     type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="shipping/destroy" method="post">
                        {{ method_field('delete') }}
                        @csrf
                        <div class="modal-body">
                            <p>هل انت متاكد إلغاء عملية الشحن</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control form-control-lg" name="vehicle_id" id="vehicle_id" value="{{$shipping->vehicle->plate_num}}" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                </div>
                </form>
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
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <script>
        $('#modaldemo8').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id')
            let vehicle_id = button.data('vehicle_id')
            let operator2_id = button.data('operator2_id')
            let modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #vehicle_id').val(vehicle_id);
            modal.find('.modal-body #operator2_id').val(operator2_id);
        })
    </script>
    <script>
        $('#modaldemo9').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id')
            let vehicle_id = button.data('vehicle_id')
            let modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #vehicle_id').val(vehicle_id);
        })
    </script>
@endsection
