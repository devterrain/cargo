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
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عمليات النقل بين المخازن</span>
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
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-warning btn-block" data-effect="effect-scale"
                           data-toggle="modal" href="#modaldemo9">نقل إلى مخزن <i class="fas fa-warehouse"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">م</th>
                                    <th class="wd-5p border-bottom-0">كود العميلة</th>
                                    <th class="wd-15p border-bottom-0">رقم القلاب</th>
                                    <th class="wd-10p border-bottom-0">سائق القلاب</th>
                                    <th class="wd-15p border-bottom-0">المخزن المنقل منه</th>
                                    <th class="wd-15p border-bottom-0">المخزن المنقول إليه</th>
                                    <th class="wd-10p border-bottom-0">رقم اللودر</th>
                                    <th class="wd-10p border-bottom-0">مشغل اللودر</th>
                                    <th class="wd-10p border-bottom-0">الكمية</th>
                                    <th class="wd-10p border-bottom-0">وقت الخروج</th>
                                    <th class="wd-10p border-bottom-0">الإعدادات</th>
                                </tr>
                            </thead>
                            <?php $i = 0; ?>
                            @foreach($inbetweens as $inbetween)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$inbetween->id}}</td>
                                    <td>{{$inbetween->vehicle->plate_num}}</td>
                                    <td>{{$inbetween->operator->operator_name}}</td>
                                    <td>{{$inbetween->store->store_name}}</td>
                                    <td>{{$inbetween->storedist->store_name}}</td>
                                    <td>لودر {{$inbetween->loader->loader_num}}</td>
                                    <td>{{$inbetween->loaderoperator->operator_name}}</td>
                                    <td>{{number_format($inbetween->weight)}}</td>

                                    <td>{{ $inbetween->load_end }}</td>
                                    <td>
                                        <a class="modal-effect btn btn-info" data-effect="effect-scale"
                                           data-id="{{ $inbetween->id }}"
                                           data-vehicle_id="{{$inbetween->vehicle->plate_num}}"
                                           data-toggle="modal" href="#exampleModal2" title="بدء العملية"><i
                                                class="fas fa-hourglass-start"></i></a>
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
        <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">عملية نقل إلى مخزن</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('inbetween.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="text" class="text-secondary">رقم المخزن المنقول منه</label>
                                <select name="store_id" id="store_id" class="form-control form-control-lg">
                                    <option disable selected>حدد رقم المخزن</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id}}" {{ old('store_id') == $store->id ? 'selected' : '' }}>{{ $store->store_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary">رقم المخزن المنقول إليه</label>
                                <select name="store_dist_id" id="store_dist_id" class="form-control form-control-lg">
                                    <option disable selected>حدد رقم المخزن</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id}}" {{ old('store_dist_id') == $store->id ? 'selected' : '' }}>{{ $store->store_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary">الحمولة</label>
                                <select name="cargo_id" id="cargo_id" class="form-control form-control-lg">
                                    <option disable selected>حدد نوع الحمولة</option>
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id}}" {{ old('cargo_id') == $store->id ? 'selected' : '' }}>{{ $cargo->cargo_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary">رقم القلاب</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-control form-control-lg" required>
                                    <option disable selected>حدد رقم السيارة</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id}}">{{ $vehicle->plate_num}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary">السائق</label>
                                <select name="operator_id" id="operator_id" class="form-control form-control-lg" required>
                                    <option disable selected>حدد اسم سائق القلاب</option>
                                    @foreach($operators as $operator)
                                        <option value="{{ $operator->id}}">{{ $operator->operator_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary">رقم اللودر</label>
                                <select name="loader_id" id="loader_id" class="form-control form-control-lg">
                                    <option disable selected>حدد رقم اللودر</option>
                                    @foreach($loaders as $loader)
                                        <option value="{{ $loader->id}}" {{ old('loader_id') == $loader->id ? 'selected' : '' }}>{{ $loader->loader_num}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary">سائق اللودر</label>
                                <select name="loader_operator_id" id="loader_operator_id" class="form-control form-control-lg">
                                    <option disable selected>حدد سائق اللودر</option>
                                    @foreach($loaderoperators as $loaderoperator)
                                        <option value="{{ $loaderoperator->id}}" {{ old('loader_operator_id') == $loaderoperator->id ? 'selected' : '' }}>{{ $loaderoperator->operator_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary">الوزن</label>
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
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
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
