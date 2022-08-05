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
        بيانات بوالص الشحن
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
                        <table id="example" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">م</th>
                                <th class="wd-15p border-bottom-0">رقم البوليصة</th>
                                <th class="wd-10p border-bottom-0">رقم السيارة</th>
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
                                           data-driver_id="{{ $policydetail->policy->driver->driver_name }}"
                                           data-origin_id="{{ $policydetail->policy->origin->origin_name }}"
                                           data-empty_weight="{{ $policydetail->policy->empty_weight }}"
                                           data-loaded_weight="{{ $policydetail->policy->loaded_weight }}"
                                           data-toggle="modal" href="#exampleModal2" title="بيانات البوليصة"><i
                                                class="fa fa-eye" aria-hidden="true"></i></a>

                                        <a class="modal-effect btn btn-lg btn-danger" data-effect="effect-scale"
                                           data-id="{{ $policydetail->id }}"
                                           data-policy_id="{{ $policydetail->policy_id }}"
                                           data-scale_notes="{{ $policydetail->scale_notes }}"
                                           data-toggle="modal" href="#modaldemo8" title="توجيه مخزن">
                                            <i class="fas fa-warehouse"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">عملية توجيه</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="policydetail/update" method="post" id="myForm">
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
                                    <label for="text">الوزن القائم (بالكيلو جرام)</label>
                                    <input type="number" class="form-control form-control-lg" id="dloaded_weight"
                                           name="dloaded_weight" min="35000" max="120000" step="20" oncopy="return false"
                                           onpaste="return false">
                                </div>
                                <div class="form-group">
                                    <label for="text">تأكيد الوزن القائم (بالكيلو جرام)</label>
                                    <input type="number"
                                           class="form-control @error('dloaded_weight_confirmation') is-invalid @enderror form-control-lg"
                                           id="dloaded_weight_confirmation"
                                           name="dloaded_weight_confirmation" min="35000" max="120000" maxlength="5" step="20"
                                           oncopy="return false" onpaste="return false">
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <label for="text">رقم الافراج</label>
                                <select name="release_id" id="release_id" class="form-control form-control-lg">
                                    <option disable selected>--رقم الافراج --</option>
                                    @foreach($releases as $release)
                                        <option value="{{ $release->id}}">{{ $release->release_num}}</option>
                                    @endforeach
                                </select>
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
                            <div class="form-group">
                                <label for="text">ملحقات السيارة</label>
                                <select name="axes" id="axes" class="selectpicker">
                                    <option disable selected>عدد الأكس</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                </select>
                                <select name="lift" id="lift" class="selectpicker">
                                    <option disable selected>عدد الكواريك</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                                <select name="exinguisher" id="exinguisher" class="selectpicker">
                                    <option disable selected>طفاية الحريق</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                                <select name="hook" id="hook" class="selectpicker">
                                    <option disable selected>هوك</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                                <select name="stove" id="stove" class="selectpicker">
                                    <option disable selected>شعلة</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                                <select name="cover" id="cover" class="selectpicker">
                                    <option disable selected>مشمع</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">ملاحظات الميزان</label>
                                <textarea class="form-control" id="scale_notes" onclick="ignition()"
                                          name="scale_notes"></textarea>
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
                        <label for="text">الوزن القائم (بالكيلو جرام)</label>
                        <input class="form-control form-control-lg" id="dloaded_weight" name="dloaded_weight"
                               value="{{number_format($policydetail->policy->loaded_weight)}}" readonly>
                    </div>
                    <div class="modal-footer">
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
    <script>
        function ignition()
        {
            const axes = document.getElementById('axes');
            const lift = document.getElementById('lift');
            const exinguisher = document.getElementById('exinguisher');
            const hook = document.getElementById('hook');
            const stove = document.getElementById('stove');
            const cover = document.getElementById('cover');
            const notes = document.getElementById('scale_notes');
            notes.innerText = axes.value + ' ' + 'أكس' + ',' + lift.value + ' ' + 'كوريك' + ',' + exinguisher.value + ' ' + 'طفاية' + ',' +  + hook.value + ' ' + 'هوك' + ',' + stove.value + ' ' + 'شعلة' + ',' +  cover.value + ' ' + 'مشمع';
        }
    </script>
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <script>
        $('#exampleModal2').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var policy_id = button.data('policy_id')
            var cargo_id = button.data('cargo_id')
            var shipping_date = button.data('shipping_date')
            var origin_id = button.data('origin_id')
            var contractor_id = button.data('contractor_id')
            var driver_id = button.data('driver_id')
            var vehicle_id = button.data('vehicle_id')
            var trailer_id = button.data('trailer_id')
            var destination_id = button.data('destination_id')
            var empty_weight = button.data('empty_weight')
            var loaded_weight = button.data('loaded_weight')
            var modal = $(this)
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
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var vehicle_id = button.data('vehicle_id')
            var policy_id = button.data('policy_id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #vehicle_id').val(vehicle_id);
            modal.find('.modal-body #policy_id').val(policy_id);
        })
    </script>

    <script>
        $('#modaldemo10').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var vehicle_id = button.data('vehicle_id')
            var policy_id = button.data('policy_id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #vehicle_id').val(vehicle_id);
            modal.find('.modal-body #policy_id').val(policy_id);
        })
    </script>
@endsection
