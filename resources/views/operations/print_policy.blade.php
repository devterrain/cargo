@extends('layouts.master')
@section('css')
    <style>
        @page {
            display: block;
            size: A4;
        }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
            }
            #print_Button {
                display: none;
            }
            .invoice-header img {
                float: left;
            }
        }
    </style>
@endsection
@section('title')
    معاينه طباعة البوليصة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">بوالص الشحن</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    معاينة طباعة البوليصة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-13">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <img src="\assets\img\brand\logo.png" alt="cairo3a" style="width:300px;height:125px;">
                            <div class="billed-from">
                                <h2>كايرو ثري ايه الدولية للاستثمار</h2>
                                <h2>CAIRO3A for International Investment</h2>
                                <h5>Building 62B, El-Tagamoe El Khames, Services Center, New Cairo, Cairo, Egypt</h5>
                                <p>Email: info@cairo3a.org</p>
                                <p>Website: https://www.cairothreea.com</p>
                            </div><!-- billed-from -->
                        </div><!-- policy-header -->
                        <hr>
                        <div class="table-responsive-lg">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="wd-25p tx-center tx-24-f" colspan="4">رقم البوليصة
                                        <strong>U-{{ $policies->id }}</strong></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="tx-20">مقاول النقل</td>
                                    <td class="tx-20">{{ $policies->contractor->contractor_name }}</td>
                                    <td class="tx-20">تاريخ الشحن</td>
                                    <td class="tx-20">{{ $policies->shipping_date }}</td>
                                </tr>
                                <tr>
                                    <td class="tx-20">اسم السائق</td>
                                    <td class="tx-20">{{ $policies->driver->driver_name }}</td>
                                    <td class="tx-20">عنوان السائق</td>
                                    <td class="tx-20">{{ $policies->driver->province }} - {{ $policies->driver->city }}
                                        - {{ $policies->driver->driver_address }}</td>
                                </tr>
                                <tr>
                                    <td class="tx-20">رخصة القيادة</td>
                                    <td class="tx-20">{{ $policies->driver->licence_num }}</td>
                                    <td class="tx-20">رقم السيارة / المقطورة</td>
                                    <td class="tx-20 font-weight-bold">{{ $policies->vehicle->plate_num }}
                                        / {{ $policies->trailer->tplate_num }}</td>
                                </tr>
                                <tr>
                                    <td class="tx-22">إسم المرسل إليه</td>
                                    <td class="tx-20 font-weight-bold">{{ $policies->destination->destination_name }}</td>
                                    <td class="tx-22">العنوان</td>
                                    <td class="tx-20 font-weight-bold">{{ $policies->destination->destination_address }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">
                        <div class="table-responsive-lg">
                            <table class="table table-bordered text-md-nowrap mb-0">
                                <thead>
                                <tr class="border">
                                    <th class="tx-20 tx-center" colspan="2">الكمية</th>
                                    <th class="tx-20 tx-center" rowspan="2">التحميل</th>
                                    <th class="tx-20 tx-center"rowspan="2">الحمولة</th>
                                    <th class="tx-20 tx-center"rowspan="2">بيانات الاستلام</th>

                                </tr>
                                <tr>
                                    <th class="tx-17">الوزن القائم (بالكيلو جرام)</th>
                                    <th class="tx-17">الوزن الفارغ (بالكيلو جرام)</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="tx-20 font-weight-bold tx-center">{{ number_format($policies->loaded_weight, 0) }}</td>
                                    <td class="tx-20 font-weight-bold tx-center">{{ number_format($policies->empty_weight, 0) }}</td>
                                    <td class="tx-20 font-weight-bold tx-center">{{ $policies->trailer->trailer_type }}</td>
                                    <td class="tx-20 font-weight-bold tx-center">{{ $policies->cargo->cargo_name }}</td>
                                    <td class="tx-20 font-weight-bold tx-center">{{ Numbers::TafqeetNumber($policies->net_weight) }}
                                        كيلو جراما
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tx-22 tx-center" colspan="5">
                                        صافي وزن الحمولة:
                                        <strong>{{ number_format($policies->net_weight) }}
                                            كيلو جراما </strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <p class="h4">التوقيع:
                                    .................................................................</p>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <div class="table-responsive-lg">
                                <table class="table table-invoice border text-md-nowrap mb-0">
                                    <tbody>
                                    <tr>
                                        <td class="tx-20" colspan="2">استلمت أنا السائق :</td>
                                        <td class="tx-20 font-weight-bold">{{ $policies->driver->driver_name }}</td>
                                        <td class="tx-20">بطاقة رقم:</td>
                                        <td class="tx-20 font-weight-bold">{{ $policies->driver->identity_num }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-20">قائد السيارة: </td>
                                        <td class="tx-20 font-weight-bold">{{ $policies->vehicle->plate_num }}</td>
                                        <td class="tx-20" >البضاعة الموضحة عليه من السادة شركة :</td>
                                        <td class="tx-20 font-weight-bold" colspan="2">{{ $policies->contractor->contractor_name }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="tx-20">
                                            وأصبحت في عهدتي وذلك بصفة أمانة لحين تسليمها إلى الجهة المرسل إليها وأصبحت مسئولا عنها مسئولية كاملة
                                            وأقر أنني عاينت البضاعة المحملة على السيارة قيادتي المعاينة النافية للجهالة وأن البضاعة بحالة ممتازة ولا تخلو مسئوليتي إلا بعد تسليم وإعادة البوليصة موقع عليها بالاستلام.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="tx-right h4">
                                            التوقيع: ........................................................
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="mg-b-40">
                        <div class="table-responsive-lg">
                            <table class="table table-invoice text-md-nowrap mb-0">
                                <tbody>
                                <tr>
                                    <td class="tx-17">استلمت أنا / </td>
                                    <td class="tx-right">..............................................................................</td>
                                    <td class="tx-17">أمين مخازن شركة </td>
                                    <td class="tx-right">..............................................................................</td>
                                </tr>
                                <tr>
                                    <td class="tx-17" colspan="2">البضاعة الموضحة عليه بالبوليصة الموضح بيانها بخانة الاستلام عاليه</td>
                                    <td class="tx-17">التاريخ: </td>
                                    <td class="tx-right">..............................................................................</td>
                                </tr>
                                <tr>
                                    <td class="tx-17">اسم المستلم</td>
                                    <td class="tx-right">..............................................................................</td>
                                    <td class="tx-17">بطاقة رقم: </td>
                                    <td class="tx-right">..............................................................................</td>
                                </tr>
                                <tr>
                                    <td class="tx-17">توقيع المستلم:</td>
                                    <td class="tx-right">..............................................................................</td>
                                    <td class="tx-17">محرر البوليصة</td>
                                    <td class="tx-right h5">[{{ $policies->user->name }}]</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"><i
                                class="mdi mdi-printer ml-1"></i>طباعة البوليصة
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->

@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection
