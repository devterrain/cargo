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
        عمليات نقل من المخزن
    @stop

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ خروج بضاعة من المخزن</span>
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
                        <a class="modal-effect btn btn-primary btn-lg" data-effect="effect-scale"
                           data-toggle="modal" href="#modaldemo8"> نقل إلى رصيف <i class="fas fa-ship"></i> </a>


                    </div>
                    <div class="d-flex justify-content-between">

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">كود العملية</th>
                                <th class="wd-10p border-bottom-0">رقم القلاب</th>
                                <th class="wd-15p border-bottom-0">رقم المخزن</th>
                                <th class="wd-10p border-bottom-0">الحمولة</th>
                                <th class="wd-10p border-bottom-0">الوردية</th>
                                <th class="wd-10p border-bottom-0">رقم اللودر</th>
                                <th class="wd-10p border-bottom-0"> مشغل اللودر</th>
                                <th class="wd-10p border-bottom-0">الكمية</th>
                                <th class="wd-10p border-bottom-0">سائق القلاب</th>
                                <th class="wd-10p border-bottom-0">وقت الخروج</th>
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
                                    <td>{{$shipping->cargo->cargo_name}}</td>
                                    <td>وردية {{$shipping->start_shift}}</td>
                                    <td>لودر {{$shipping->loader->loader_num}}</td>
                                    <td>{{$shipping->loaderoperator->operator_name}}</td>
                                    <td>{{number_format($shipping->weight)}}</td>
                                    <td>{{$shipping->operator->operator_name}}</td>
                                    <td>{{ $shipping->load_end }}</td>

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
                        <h6 class="modal-title">عملية شحن إلى سفينة</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('outgoing.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="text" class="text-primary">الوردية</label>
                                <select name="start_shift" id="start_shift" class="form-control form-control-lg">
                                    <option disable selected>حدد الوردية</option>
                                        <option value="1" {{ old('start_shift') == 1 ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ old('start_shift') == 2 ? 'selected' : '' }}>2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-primary">رقم المخزن</label>
                                <select name="store_id" id="store_id" class="form-control form-control-lg">
                                    <option disable selected>حدد رقم المخزن</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id}}" {{ old('store_id') == $store->id ? 'selected' : '' }}>{{ $store->store_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-primary">نوع الحمولة</label>
                                <select name="cargo_id" id="cargo_id" class="form-control form-control-lg">
                                    <option disable selected>حدد الحمولة</option>
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id}}" {{ old('cargo_id') == $cargo->id ? 'selected' : '' }}>{{ $cargo->cargo_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-primary">رحلة السفينة</label>
                                <select name="shiptrip_id" id="shiptrip_id" class="form-control form-control-lg">
                                    <option disable selected>--حدد رحلة السفينة--</option>
                                    @foreach($shiptrips as $shiptrip)
                                        <option value="{{ $shiptrip->id}}" {{ old('shiptrip_id') == $shiptrip->id ? 'selected' : '' }}>{{ $shiptrip->arrival_date}} - {{ $shiptrip->ship->ship_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-primary">رقم القلاب</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-control form-control-lg" required>
                                    <option disable selected>حدد رقم السيارة</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id}}">{{ $vehicle->plate_num}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-primary">سائق القلاب</label>
                                <select name="operator_id" id="operator_id" class="form-control form-control-lg" required>
                                    <option disable selected>حدد اسم سائق القلاب</option>
                                    @foreach($operators as $operator)
                                        <option value="{{ $operator->id}}">{{ $operator->operator_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-primary">رقم اللودر</label>
                                <select name="loader_id" id="loader_id" class="form-control form-control-lg">
                                    <option disable selected>حدد رقم اللودر</option>
                                    @foreach($loaders as $loader)
                                        <option value="{{ $loader->id}}" {{ old('loader_id') == $loader->id ? 'selected' : '' }}>{{ $loader->loader_num}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-primary">سائق اللودر</label>
                                <select name="loader_operator_id" id="loader_operator_id" class="form-control form-control-lg">
                                    <option disable selected>حدد سائق اللودر</option>
                                    @foreach($loaderoperators as $loaderoperator)
                                        <option value="{{ $loaderoperator->id}}" {{ old('loader_operator_id') == $loaderoperator->id ? 'selected' : '' }}>{{ $loaderoperator->operator_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-primary">الوزن</label>
                                <input type="number" class="form-control form-control-lg" name="weight" id="weight" value="33000">
                            </div>
                            <div class="form-group">
                                <label for="text">ملاحظات</label>
                                <textarea name="load_notes" id="load_notes"
                                          class="form-control form-control-lg"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"> تأكيد خروج حمولة</button>
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
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <script>
        $('#exampleModal2').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let id = button.data('id');
            let vehicle_id = button.data('vehicle_id')
            let policy_id = button.data('policy_id')
            let modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #vehicle_id').val(vehicle_id);
            modal.find('.modal-body #policy_id').val(policy_id);
        })
    </script>

    <script>
        $('#modaldemo8').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id')
            let vehicle_id = button.data('vehicle_id')
            let policy_id = button.data('policy_id')
            let modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #vehicle_id').val(vehicle_id);
            modal.find('.modal-body #policy_id').val(policy_id);
        })
    </script>

@endsection
