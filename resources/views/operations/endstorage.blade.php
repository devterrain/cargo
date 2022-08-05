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
        عمليات التفريغ الجارية
    @stop

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سيارات بالمخزن</span>
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
                        <h4 class="display-5 center">سيارات بالتفريغ</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">م</th>
                                <th class="wd-15p border-bottom-0">رقم السيارة</th>
                                <th class="wd-15p border-bottom-0">رقم البوليصة</th>
                                <th class="wd-10p border-bottom-0">رقم المخزن</th>
                                <th class="wd-10p border-bottom-0">بدء التخزين</th>
                                <th class="wd-10p border-bottom-0">ملاحظات</th>
                                <th class="wd-10p border-bottom-0">الإعدادات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach($policydetails as $policydetail)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$policydetail->policy->vehicle->plate_num}}</td>
                                    <td>{{$policydetail->policy->id}}</td>
                                    <td>{{$policydetail->store->store_name}}</td>
                                    <td>{{$policydetail->unload_start}}</td>
                                    <td>{{$policydetail->unload_notes}}</td>
                                    <td>
                                        <a class="modal-effect btn btn-success" data-effect="effect-scale"
                                           data-id="{{ $policydetail->id }}"
                                           data-policy_id="{{ $policydetail->policy_id }}"
                                           data-vehicle_id="{{$policydetail->policy->vehicle->plate_num}}"
                                           data-unload_start="{{$policydetail->unload_start}}"
                                           data-unload_notes="{{$policydetail->unload_notes}}"
                                           data-toggle="modal" href="#exampleModal2" title="إنهاء العملية"><i
                                                class="fas fa-hourglass-end"></i></a>


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
                        <h6 class="modal-title">إنهاء عملية التخزين للسيارة</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="endstorage/update" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="text">رقم البوليصة</label>
                                <input class="form-control form-control-lg" id="policy_id" name="policy_id"
                                       value="U {{$policydetail->policy_id}}" readonly>
                            </div>
                            {{-- <div class="form-group">
                                <label for="text" class="text-secondary font-weight-bold">اللودر الأول</label>
                                <select name="loader_id" id="loader_id" class="form-control form-control-lg">
                                    <option value="{{$loaders->loader_id = null}}" disable selected> حدد رقم اللودر</option>
                                    @foreach($loaders as $loader)
                                        <option value="{{ $loader->id}}" {{ old('loader_id') == $loader->id ? 'selected' : '' }}>لودر رقم {{ $loader->loader_num}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary font-weight-bold">مشغل اللودر الأول</label>
                                <select name="loader_operator_id" id="loader_operator_id" class="form-control form-control-lg">
                                    <option value="{{$loaderoperators->loader_operator_id = null}}" disable selected> حدد اسم مشغل اللودر</option>
                                    @foreach($loaderoperators as $loaderoperator)
                                        <option value="{{ $loaderoperator->id}}" {{ old('loader_operator_id') == $loaderoperator->id ? 'selected' : '' }}>{{ $loaderoperator->operator_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary font-weight-bold">لودر (2)</label>
                                <select name="loader2_id" id="loader2_id" class="form-control form-control-lg">
                                    <option value="{{$loaders->loader_id = null}}" disable selected> حدد رقم اللودر الثاني</option>
                                    @foreach($loaders as $loader)
                                        <option value="{{ $loader->id}}" {{ old('loader2_id') == $loader->id ? 'selected' : '' }}>لودر رقم {{ $loader->loader_num}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary font-weight-bold">مشغل اللودر الثاني</label>
                                <select name="loader2_operator_id" id="loader2_operator_id" class="form-control form-control-lg">
                                    <option value="NULL" disable selected> حدد مشغل اللودر الثاني</option>
                                    @foreach($loaderoperators as $loaderoperator)
                                        <option value="{{ $loaderoperator->id}}" {{ old('loader2_operator_id') == $loaderoperator->id ? 'selected' : '' }}>{{ $loaderoperator->operator_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary font-weight-bold">رقم السير</label>
                                <select name="convair_id" id="convair_id" class="form-control form-control-lg">
                                    <option value="NULL" disable selected> حدد رقم السير</option>
                                    @foreach($convairs as $convair)
                                        <option value="{{ $convair->id}}" {{ old('convair_id') == $convair->id ? 'selected' : '' }}>سير رقم {{ $convair->convair_num}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text" class="text-secondary font-weight-bold">مشغل السير</label>
                                <select name="convair_operator_id" id="convair_operator_id" class="form-control form-control-lg">
                                    <option value="NULL" disable selected> حدد اسم مشغل السير</option>
                                    @foreach($convairoperators as $convairoperator)
                                        <option value="{{ $convairoperator->id}}" {{ old('convair_operator_id') == $convairoperator->id ? 'selected' : '' }}>{{ $convairoperator->operator_name}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="text">رقم السيارة</label>
                                <input class="form-control form-control-lg" id="vehicle_id" name="vehicle_id"
                                       value="{{$policydetail->policy->vehicle->plate_num}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="text">توقيت بدء التخزين</label>
                                <input class="form-control form-control-lg" id="unload_start" name="unload_start"
                                       value="{{$policydetail->unload_start}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="unload_notes">ملاحظات</label><textarea name="unload_notes" id="unload_notes"
                                                                            class="form-control form-control-lg"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"> تأكيد إنتهاء التفريغ</button>
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
                    let unload_notes = button.data('unload_notes')
                    let unload_start = button.data('unload_start')
                    let modal = $(this)
                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #vehicle_id').val(vehicle_id);
                    modal.find('.modal-body #policy_id').val(policy_id);
                    modal.find('.modal-body #unload_notes').val(unload_notes);
                    modal.find('.modal-body #unload_start').val(unload_start);
                })
            </script>

@endsection
