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
        الوزن الفارغ للسيارات
    @stop

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ البضائع الواردة</span>
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
                        <h6 class="display-5 center">البضائع الواردة</h6>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (isset($policydetails))
                            <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">م</th>
                                    <th class="wd-15p border-bottom-0">رقم البوليصة</th>
                                    <th class="wd-10p border-bottom-0">رقم السيارة</th>
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
                                        <td>U {{$policydetail->policy_id}}</td>
                                        <td>{{$policydetail->policy->vehicle->plate_num}}</td>
                                        <td>{{$policydetail->scale_notes}}</td>
                                        <td>
                                            <a class="modal-effect btn btn-lg btn-info" data-effect="effect-scale"
                                               data-id="{{ $policydetail->id }}"
                                               data-policy_id="{{ $policydetail->policy_id }}"
                                               data-cargo_id="{{ $policydetail->policy->cargo->cargo_name }}"
                                               data-shipping_date="{{ $policydetail->policy->shipping_date }}"
                                               data-vehicle_id="{{ $policydetail->policy->vehicle->plate_num }}"
                                               data-trailer_id="{{ $policydetail->policy->trailer->tplate_num }}"
                                               data-destination_id="{{ $policydetail->policy->destination->destination_name }}"
                                               data-contractor_id="{{ $policydetail->policy->contractor->contractor_name }}"
                                               data-origin_id="{{ $policydetail->policy->origin->origin_name }}"
                                               data-driver_id="{{ $policydetail->policy->driver->driver_name}}"
                                               data-empty_weight="{{ $policydetail->policy->empty_weight }}"
                                               data-loaded_weight="{{ $policydetail->policy->loaded_weight }}"
                                               data-toggle="modal" href="#exampleModal2" title="بيانات البوليصة"><i
                                                    class="fa fa-eye" aria-hidden="true"></i></a>

                                            <a class="modal-effect btn btn-lg btn-success" data-effect="effect-scale"
                                               data-id="{{ $policydetail->id }}"
                                               data-policy_id="{{ $policydetail->policy_id }}"
                                               data-scale_notes="{{ $policydetail->scale_notes }}"
                                               data-toggle="modal" href="#modaldemo8" title="الوزن الفارغ">
                                                <i class="fa fa-solid fa-check"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="modal" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h5 class="modal-title">الوزن الفارغ للسيارة</h5>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="secondscale/update" method="post" id="myForm">
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
                            <fieldset class="form-group">
                                <legend class="h5 text-center text-danger">الوزن القائم</legend>
                                <div class="form-group">
                                    <label for="text">الوزن الفارغ</label>
                                    <input type="number"
                                           class="form-control @error('dempty_weight') is-invalid @enderror form-control-lg"
                                           id="dempty_weight"
                                           name="dempty_weight" maxlength="5" step="20" oncopy="return false"
                                           onpaste="return false" required>
                                </div>
                                <div class="form-group">
                                    <label for="text">تأكيد الوزن الفارغ</label>
                                    <input type="number"
                                           class="form-control @error('dempty_weight_confirmation') is-invalid @enderror form-control-lg"
                                           id="dempty_weight_confirmation"
                                           name="dempty_weight_confirmation" maxlength="5" step="20"
                                           oncopy="return false" onpaste="return false" required>
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <label for="scale_notes">ملاحظات الميزان</label>
                                <textarea class="form-control form-control-lg" id="scale_notes"
                                          name="scale_notes" disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label for="scale_notes">ملاحظات أخرى</label>
                                <textarea class="form-control form-control-lg" id="other_notes"
                                          name="other_notes"></textarea>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">تاكيد الوزن الفارغ للسيارة</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal effects-->
        <!-- edit -->
    </div>
    <!-- edit -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تفاصيل البوليصة</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="">
                        <label for="text">تاريخ الشحن</label>
                        <input class="form-control form-control-lg" id="shipping_date" name="shipping_date" readonly>
                    </div>
                    <div class="form-group">
                        <label for="text">رقم البوليصة</label>
                        <input class="form-control form-control-lg" id="policy_id" name="policy_id"
                               value="U{{$policydetail->policy_id}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="text">مقاول النقل</label>
                        <input class="form-control form-control-lg" id="contractor_id" name="contractor_id"
                               value="{{$policydetail->policy->contractor->contractor_name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="text">رقم السيارة</label>
                        <input class="form-control form-control-lg" id="vehicle_id" name="vehicle_id"
                               value="{{$policydetail->policy->vehicle->plate_num}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="text">رقم المقطورة</label>
                        <input class="form-control form-control-lg" id="trailer_id" name="trailer_id"
                               value="{{$policydetail->policy->trailer->tplate_num}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="text">الحمولة</label>
                        <input class="form-control form-control-lg" id="cargo_id" name="cargo_id"
                               value="{{$policydetail->policy->cargo->cargo_name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="text">الراسل</label>
                        <input class="form-control form-control-lg" id="origin_id" name="origin_id"
                               value="{{$policydetail->policy->origin->origin_name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="text">المرسل اليه</label>
                        <input class="form-control form-control-lg" id="destination_id" name="destination_id"
                               value="{{$policydetail->policy->destination->destination_name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="text">السائق</label>
                        <input class="form-control form-control-lg" id="driver_id" name="driver_id"
                               value="{{$policydetail->policy->driver->driver_name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="text">الوزن الفارغ</label>
                        <input class="form-control form-control-lg" id="empty_weight" name="empty_weight"
                               value="{{ number_format($policydetail->policy->empty_weight) }}" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Container closed -->
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
        $('#exampleModal2').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let id = button.data('id')
            let policy_id = button.data('policy_id')
            let cargo_id = button.data('cargo_id')
            let shipping_date = button.data('shipping_date')
            let origin_id = button.data('origin_id')
            let contractor_id = button.data('contractor_id')
            let driver_id = button.data('driver_id')
            let vehicle_id = button.data('vehicle_id')
            let trailer_id = button.data('trailer_id')
            let destination_id = button.data('destination_id')
            let empty_weight = button.data('empty_weight')
            let loaded_weight = button.data('loaded_weight')
            let modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #policy_id').val(policy_id);
            modal.find('.modal-body #cargo_id').val(cargo_id);
            modal.find('.modal-body #shipping_date').val(shipping_date);
            modal.find('.modal-body #origin_id').val(origin_id);
            modal.find('.modal-body #contractor_id').val(contractor_id);
            modal.find('.modal-body #driver_id').val(driver_id);
            modal.find('.modal-body #vehicle_id').val(vehicle_id);
            modal.find('.modal-body #trailer_id').val(trailer_id);
            modal.find('.modal-body #destination_id').val(destination_id);
            modal.find('.modal-body #empty_weight').val(empty_weight);
            modal.find('.modal-body #loaded_weight').val(loaded_weight);
        })
    </script>

    <script>
        $('#modaldemo8').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id')
            let vehicle_id = button.data('vehicle_id')
            let policy_id = button.data('policy_id')
            let scale_notes = button.data('scale_notes')
            let modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #vehicle_id').val(vehicle_id);
            modal.find('.modal-body #policy_id').val(policy_id);
            modal.find('.modal-body #scale_notes').val(scale_notes);
        })
    </script>

@endsection
