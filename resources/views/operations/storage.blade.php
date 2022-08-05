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
        عمليات التخزين
    @stop

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سيارات في انتظار التفريغ</span>
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
                        <h4 class="display-5 center">إنتظار التفريغ</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">م</th>
                                <th class="wd-10p border-bottom-0">رقم السيارة</th>
                                <th class="wd-10p border-bottom-0">رقم البوليصة</th>
                                <th class="wd-10p border-bottom-0">رقم المخزن</th>
                                <th class="wd-10p border-bottom-0">الإعدادات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach($policydetails as $policydetail)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td class="h4">{{$policydetail->policy->vehicle->plate_num}}</td>
                                    <td>U {{$policydetail->policy->id}}</td>
                                    <td>{{$policydetail->store->store_name}}</td>
                                    <td>
                                        <a class="modal-effect btn btn-info" data-effect="effect-scale"
                                           data-id="{{ $policydetail->id }}"
                                           data-policy_id="{{ $policydetail->policy_id }}"
                                           data-vehicle_id="{{$policydetail->policy->vehicle->plate_num}}"
                                           data-toggle="modal" href="#exampleModal2" title="بدء العملية"><i
                                                class="fas fa-hourglass-start"></i></a>

                                        <a class="modal-effect btn btn-warning" data-effect="effect-scale"
                                           data-id="{{ $policydetail->id }}"
                                           data-store_id="{{$policydetail->store_id}}"
                                           data-toggle="modal" href="#modaldemo10" title="إعادة التوجيه"><i
                                                class="fas fa-external-link-alt"></i></a>

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
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">بداية عملية التخزين</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="storage/update" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="text">رقم البوليصة</label>
                                <input class="form-control form-control-lg" id="policy_id" name="policy_id"
                                       value="{{$policydetail->policy_id}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="text">رقم السيارة</label>
                                <input class="form-control form-control-lg" id="vehicle_id" name="vehicle_id"
                                       value="{{$policydetail->policy->vehicle->plate_num}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="text">ملاحظات</label>
                                <textarea name="unload_notes" id="unload_notes"
                                          class="form-control form-control-lg"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"> تأكيد بدأ التفريغ</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modaldemo10">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">إعادة التوجيه</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="redirect/update" method="post" id="myForm">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <div class="form-group">
                                    <label for="text">رقم البوليصة</label>
                                    <input class="form-control form-control-lg" id="policy_id" name="policy_id"
                                           value="{{$policydetail->policy_id}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text">رقم المخزن</label>
                                <select name="store_id" id="store_id" class="form-control form-control-lg">
                                    <option disable selected>--حدد المخزن --</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id}}">{{ $store->store_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                    </form>
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
                $('#modaldemo10').on('show.bs.modal', function (event) {
                    let button = $(event.relatedTarget)
                    let id = button.data('id');
                    let vehicle_id = button.data('vehicle_id')
                    let store_id = button.data('store_id')
                    let modal = $(this)
                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #vehicle_id').val(vehicle_id);
                    modal.find('.modal-body #store_id').val(store_id);
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
