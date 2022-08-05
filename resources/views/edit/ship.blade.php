@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@section('title')
بيانات سفن الشحن
@stop
@endsection
@section('javascript')
<script>
	$(document).ready(function() {
	$('#example').DataTable({
		dom: 'Bfrtip',
		buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
		});
	});
</script>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سفن الشحن</span>
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
				<!-- row -->
				<div class="row">


                        <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة سفينة جديدة</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
										<thead>
											<tr>
												<th class="wd-10p border-bottom-0">م</th>
												<th class="wd-15p border-bottom-0">اسم السفينة</th>
												<th class="wd-20p border-bottom-0">البلد</th>
												<th class="wd-15p border-bottom-0">عدد عنابر السفينة</th>
												<th class="wd-10p border-bottom-0">أبعاد السفينة</th>
												<th class="wd-15p border-bottom-0">سعة السفينة</th>
												<th class="wd-25p border-bottom-0">إعداد بيانات السفينة</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 0; ?>
											@foreach ($ships as $ship)
											<?php $i++; ?>
											<tr>
												<td>{{$i}}</td>
												<td>{{$ship->ship_name}}</td>
												<td>{{$ship->country}}</td>
												<td>{{$ship->gate_number}}</td>
												<td>{{$ship->ship_dimensions}}</td>
												<td>{{$ship->ship_capacity}}</td>
												<td>
                                                    <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                       data-id="{{ $ship->id }}" data-ship_name="{{ $ship->ship_name }}"
                                                       data-country="{{ $ship->country }}" data-gate_number="{{ $ship->gate_number }}"
													   data-ship_dimensions="{{ $ship->ship_dimensions }}" data-ship_capacity="{{ $ship->ship_capacity }}"
													   data-toggle="modal" href="#exampleModal2"
                                                       title="بيانات السفينة"><i class="las la-pen"></i></a>
												</td>
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
									<h6 class="modal-title">اضافة سفينة جديدة</h6><button aria-label="Close" class="close" data-dismiss="modal"
										type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<form action="{{route('ship.store')}}" method="post">
										@csrf
										<div class="form-group">
											<label for="text">اسم السفينة</label>
											<input type="text" style="text-transform:uppercase" class="form-control" id="ship_name" name="ship_name" required>
										</div>

										<div class="mb-3">
											<label for="text">جنسية السفينة</label>
											<select class="form-control" aria-label="حدد جنسية السفينة" name="country" id="country">
												<option value="" disabled selected>إختر</option>
												<option value="أفغانستان">أفغانستان</option>
												<option value="ألبانيا">ألبانيا</option>
												<option value="الجزائر">الجزائر</option>
												<option value="أندورا">أندورا</option>
												<option value="أنغولا">أنغولا</option>
												<option value="أنتيغوا وباربودا">أنتيغوا وباربودا</option>
												<option value="الأرجنتين">الأرجنتين</option>
												<option value="أرمينيا">أرمينيا</option>
												<option value="أستراليا">أستراليا</option>
												<option value="النمسا">النمسا</option>
												<option value="أذربيجان">أذربيجان</option>
												<option value="البهاما">البهاما</option>
												<option value="البحرين">البحرين</option>
												<option value="بنغلاديش">بنغلاديش</option>
												<option value="باربادوس">باربادوس</option>
												<option value="بيلاروسيا">بيلاروسيا</option>
												<option value="بلجيكا">بلجيكا</option>
												<option value="بليز">بليز</option>
												<option value="بنين">بنين</option>
												<option value="بوتان">بوتان</option>
												<option value="بوليفيا">بوليفيا</option>
												<option value="البوسنة والهرسك ">البوسنة والهرسك </option>
												<option value="بوتسوانا">بوتسوانا</option>
												<option value="البرازيل">البرازيل</option>
												<option value="بروناي">بروناي</option>
												<option value="بلغاريا">بلغاريا</option>
												<option value="بوركينا فاسو ">بوركينا فاسو </option>
												<option value="بوروندي">بوروندي</option>
												<option value="كمبوديا">كمبوديا</option>
												<option value="الكاميرون">الكاميرون</option>
												<option value="كندا">كندا</option>
												<option value="الرأس الأخضر">الرأس الأخضر</option>
												<option value="جمهورية أفريقيا الوسطى ">جمهورية أفريقيا الوسطى </option>
												<option value="تشاد">تشاد</option>
												<option value="تشيلي">تشيلي</option>
												<option value="الصين">الصين</option>
												<option value="كولومبيا">كولومبيا</option>
												<option value="جزر القمر">جزر القمر</option>
												<option value="كوستاريكا">كوستاريكا</option>
												<option value="ساحل العاج">ساحل العاج</option>
												<option value="كرواتيا">كرواتيا</option>
												<option value="كوبا">كوبا</option>
												<option value="قبرص">قبرص</option>
												<option value="التشيك">التشيك</option>
												<option value="جمهورية الكونغو الديمقراطية">جمهورية الكونغو الديمقراطية</option>
												<option value="الدنمارك">الدنمارك</option>
												<option value="جيبوتي">جيبوتي</option>
												<option value="دومينيكا">دومينيكا</option>
												<option value="جمهورية الدومينيكان">جمهورية الدومينيكان</option>
												<option value="تيمور الشرقية ">تيمور الشرقية </option>
												<option value="الإكوادور">الإكوادور</option>
												<option value="مصر">مصر</option>
												<option value="السلفادور">السلفادور</option>
												<option value="غينيا الاستوائية">غينيا الاستوائية</option>
												<option value="إريتريا">إريتريا</option>
												<option value="إستونيا">إستونيا</option>
												<option value="إثيوبيا">إثيوبيا</option>
												<option value="فيجي">فيجي</option>
												<option value="فنلندا">فنلندا</option>
												<option value="فرنسا">فرنسا</option>
												<option value="الغابون">الغابون</option>
												<option value="غامبيا">غامبيا</option>
												<option value="جورجيا">جورجيا</option>
												<option value="ألمانيا">ألمانيا</option>
												<option value="غانا">غانا</option>
												<option value="اليونان">اليونان</option>
												<option value="جرينادا">جرينادا</option>
												<option value="غواتيمالا">غواتيمالا</option>
												<option value="غينيا">غينيا</option>
												<option value="غينيا بيساو">غينيا بيساو</option>
												<option value="غويانا">غويانا</option>
												<option value="هايتي">هايتي</option>
												<option value="هندوراس">هندوراس</option>
												<option value="المجر">المجر</option>
												<option value="آيسلندا">آيسلندا</option>
												<option value="الهند">الهند</option>
												<option value="إندونيسيا">إندونيسيا</option>
												<option value="إيران">إيران</option>
												<option value="العراق">العراق</option>
												<option value="جمهورية أيرلندا ">جمهورية أيرلندا </option>
												<option value="فلسطين">فلسطين</option>
												<option value="إيطاليا">إيطاليا</option>
												<option value="جامايكا">جامايكا</option>
												<option value="اليابان">اليابان</option>
												<option value="الأردن">الأردن</option>
												<option value="كازاخستان">كازاخستان</option>
												<option value="كينيا">كينيا</option>
												<option value="كيريباتي">كيريباتي</option>
												<option value="الكويت">الكويت</option>
												<option value="قرغيزستان">قرغيزستان</option>
												<option value="لاوس">لاوس</option>
												<option value="لاوس">لاوس</option>
												<option value="لاتفيا">لاتفيا</option>
												<option value="لبنان">لبنان</option>
												<option value="ليسوتو">ليسوتو</option>
												<option value="ليبيريا">ليبيريا</option>
												<option value="ليبيا">ليبيا</option>
												<option value="ليختنشتاين">ليختنشتاين</option>
												<option value="ليتوانيا">ليتوانيا</option>
												<option value="لوكسمبورغ">لوكسمبورغ</option>
												<option value="مدغشقر">مدغشقر</option>
												<option value="مالاوي">مالاوي</option>
												<option value="ماليزيا">ماليزيا</option>
												<option value="جزر المالديف">جزر المالديف</option>
												<option value="مالي">مالي</option>
												<option value="مالطا">مالطا</option>
												<option value="جزر مارشال">جزر مارشال</option>
												<option value="موريتانيا">موريتانيا</option>
												<option value="موريشيوس">موريشيوس</option>
												<option value="المكسيك">المكسيك</option>
												<option value="مايكرونيزيا">مايكرونيزيا</option>
												<option value="مولدوفا">مولدوفا</option>
												<option value="موناكو">موناكو</option>
												<option value="منغوليا">منغوليا</option>
												<option value="الجبل الأسود">الجبل الأسود</option>
												<option value="المغرب">المغرب</option>
												<option value="موزمبيق">موزمبيق</option>
												<option value="بورما">بورما</option>
												<option value="ناميبيا">ناميبيا</option>
												<option value="ناورو">ناورو</option>
												<option value="نيبال">نيبال</option>
												<option value="هولندا">هولندا</option>
												<option value="نيوزيلندا">نيوزيلندا</option>
												<option value="نيكاراجوا">نيكاراجوا</option>
												<option value="النيجر">النيجر</option>
												<option value="نيجيريا">نيجيريا</option>
												<option value="كوريا الشمالية ">كوريا الشمالية </option>
												<option value="النرويج">النرويج</option>
												<option value="سلطنة عمان">سلطنة عمان</option>
												<option value="باكستان">باكستان</option>
												<option value="بالاو">بالاو</option>
												<option value="بنما">بنما</option>
												<option value="بابوا غينيا الجديدة">بابوا غينيا الجديدة</option>
												<option value="باراغواي">باراغواي</option>
												<option value="بيرو">بيرو</option>
												<option value="الفلبين">الفلبين</option>
												<option value="بولندا">بولندا</option>
												<option value="البرتغال">البرتغال</option>
												<option value="قطر">قطر</option>
												<option value="جمهورية الكونغو">جمهورية الكونغو</option>
												<option value="جمهورية مقدونيا">جمهورية مقدونيا</option>
												<option value="رومانيا">رومانيا</option>
												<option value="روسيا">روسيا</option>
												<option value="رواندا">رواندا</option>
												<option value="سانت كيتس ونيفيس">سانت كيتس ونيفيس</option>
												<option value="سانت لوسيا">سانت لوسيا</option>
												<option value="سانت فنسينت والجرينادينز">سانت فنسينت والجرينادينز</option>
												<option value="ساموا">ساموا</option>
												<option value="سان مارينو">سان مارينو</option>
												<option value="ساو تومي وبرينسيب">ساو تومي وبرينسيب</option>
												<option value="السعودية">السعودية</option>
												<option value="السنغال">السنغال</option>
												<option value="صربيا">صربيا</option>
												<option value="سيشيل">سيشيل</option>
												<option value="سيراليون">سيراليون</option>
												<option value="سنغافورة">سنغافورة</option>
												<option value="سلوفاكيا">سلوفاكيا</option>
												<option value="سلوفينيا">سلوفينيا</option>
												<option value="جزر سليمان">جزر سليمان</option>
												<option value="الصومال">الصومال</option>
												<option value="جنوب أفريقيا">جنوب أفريقيا</option>
												<option value="كوريا الجنوبية">كوريا الجنوبية</option>
												<option value="جنوب السودان">جنوب السودان</option>
												<option value="إسبانيا">إسبانيا</option>
												<option value="سريلانكا">سريلانكا</option>
												<option value="السودان">السودان</option>
												<option value="سورينام">سورينام</option>
												<option value="سوازيلاند">سوازيلاند</option>
												<option value="السويد">السويد</option>
												<option value="سويسرا">سويسرا</option>
												<option value="سوريا">سوريا</option>
												<option value="طاجيكستان">طاجيكستان</option>
												<option value="تنزانيا">تنزانيا</option>
												<option value="تايلاند">تايلاند</option>
												<option value="توغو">توغو</option>
												<option value="تونجا">تونجا</option>
												<option value="ترينيداد وتوباغو">ترينيداد وتوباغو</option>
												<option value="تونس">تونس</option>
												<option value="تركيا">تركيا</option>
												<option value="تركمانستان">تركمانستان</option>
												<option value="توفالو">توفالو</option>
												<option value="أوغندا">أوغندا</option>
												<option value="أوكرانيا">أوكرانيا</option>
												<option value="الإمارات العربية المتحدة">الإمارات العربية المتحدة</option>
												<option value="المملكة المتحدة">المملكة المتحدة</option>
												<option value="الولايات المتحدة">الولايات المتحدة</option>
												<option value="أوروغواي">أوروغواي</option>
												<option value="أوزبكستان">أوزبكستان</option>
												<option value="فانواتو">فانواتو</option>
												<option value="فنزويلا">فنزويلا</option>
												<option value="فيتنام">فيتنام</option>
												<option value="اليمن">اليمن</option>
												<option value="زامبيا">زامبيا</option>
												<option value="زيمبابوي">زيمبابوي</option>
											  </select>
										</div>
										<div class="form-group">
											<label for="text">عدد العنابر</label>
											<input type="number" class="form-control" id="gate_number" name="gate_number" min="1">
										</div>
										<div class="form-group">
											<label for="text">أبعاد السفينة</label>
											<input type="text" class="form-control" id="ship_dimensions" name="ship_dimensions">
										</div>
										<div class="form-group">
											<label for="text">سعة السفينة</label>
											<input type="number" class="form-control" id="ship_capacity" name="ship_capacity" min="1" required>
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
							<h6 class="modal-title">تعديل بيانات السفينة</h6><button aria-label="Close" class="close" data-dismiss="modal"
								type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form action="ship/update" method="post" autocomplete="off">
								{{method_field('patch')}}
								@csrf
								<div class="form-group">
									<input type="hidden" name="id" id="id" value="">
									<label for="text">اسم السفينة</label>
									<input type="text" class="form-control" id="ship_name" name="ship_name" required>
								</div>
								<div class="mb-3">
									<label for="text">جنسية السفينة</label>
									<select class="form-select" aria-label="حدد جنسية السفينة" name="country" id="country">
										<option value="" disabled selected>إختر</option>
										<option value="أفغانستان">أفغانستان</option>
										<option value="ألبانيا">ألبانيا</option>
										<option value="الجزائر">الجزائر</option>
										<option value="أندورا">أندورا</option>
										<option value="أنغولا">أنغولا</option>
										<option value="أنتيغوا وباربودا">أنتيغوا وباربودا</option>
										<option value="الأرجنتين">الأرجنتين</option>
										<option value="أرمينيا">أرمينيا</option>
										<option value="أستراليا">أستراليا</option>
										<option value="النمسا">النمسا</option>
										<option value="أذربيجان">أذربيجان</option>
										<option value="البهاما">البهاما</option>
										<option value="البحرين">البحرين</option>
										<option value="بنغلاديش">بنغلاديش</option>
										<option value="باربادوس">باربادوس</option>
										<option value="بيلاروسيا">بيلاروسيا</option>
										<option value="بلجيكا">بلجيكا</option>
										<option value="بليز">بليز</option>
										<option value="بنين">بنين</option>
										<option value="بوتان">بوتان</option>
										<option value="بوليفيا">بوليفيا</option>
										<option value="البوسنة والهرسك ">البوسنة والهرسك </option>
										<option value="بوتسوانا">بوتسوانا</option>
										<option value="البرازيل">البرازيل</option>
										<option value="بروناي">بروناي</option>
										<option value="بلغاريا">بلغاريا</option>
										<option value="بوركينا فاسو ">بوركينا فاسو </option>
										<option value="بوروندي">بوروندي</option>
										<option value="كمبوديا">كمبوديا</option>
										<option value="الكاميرون">الكاميرون</option>
										<option value="كندا">كندا</option>
										<option value="الرأس الأخضر">الرأس الأخضر</option>
										<option value="جمهورية أفريقيا الوسطى ">جمهورية أفريقيا الوسطى </option>
										<option value="تشاد">تشاد</option>
										<option value="تشيلي">تشيلي</option>
										<option value="الصين">الصين</option>
										<option value="كولومبيا">كولومبيا</option>
										<option value="جزر القمر">جزر القمر</option>
										<option value="كوستاريكا">كوستاريكا</option>
										<option value="ساحل العاج">ساحل العاج</option>
										<option value="كرواتيا">كرواتيا</option>
										<option value="كوبا">كوبا</option>
										<option value="قبرص">قبرص</option>
										<option value="التشيك">التشيك</option>
										<option value="جمهورية الكونغو الديمقراطية">جمهورية الكونغو الديمقراطية</option>
										<option value="الدنمارك">الدنمارك</option>
										<option value="جيبوتي">جيبوتي</option>
										<option value="دومينيكا">دومينيكا</option>
										<option value="جمهورية الدومينيكان">جمهورية الدومينيكان</option>
										<option value="تيمور الشرقية ">تيمور الشرقية </option>
										<option value="الإكوادور">الإكوادور</option>
										<option value="مصر">مصر</option>
										<option value="السلفادور">السلفادور</option>
										<option value="غينيا الاستوائية">غينيا الاستوائية</option>
										<option value="إريتريا">إريتريا</option>
										<option value="إستونيا">إستونيا</option>
										<option value="إثيوبيا">إثيوبيا</option>
										<option value="فيجي">فيجي</option>
										<option value="فنلندا">فنلندا</option>
										<option value="فرنسا">فرنسا</option>
										<option value="الغابون">الغابون</option>
										<option value="غامبيا">غامبيا</option>
										<option value="جورجيا">جورجيا</option>
										<option value="ألمانيا">ألمانيا</option>
										<option value="غانا">غانا</option>
										<option value="اليونان">اليونان</option>
										<option value="جرينادا">جرينادا</option>
										<option value="غواتيمالا">غواتيمالا</option>
										<option value="غينيا">غينيا</option>
										<option value="غينيا بيساو">غينيا بيساو</option>
										<option value="غويانا">غويانا</option>
										<option value="هايتي">هايتي</option>
										<option value="هندوراس">هندوراس</option>
										<option value="المجر">المجر</option>
										<option value="آيسلندا">آيسلندا</option>
										<option value="الهند">الهند</option>
										<option value="إندونيسيا">إندونيسيا</option>
										<option value="إيران">إيران</option>
										<option value="العراق">العراق</option>
										<option value="جمهورية أيرلندا ">جمهورية أيرلندا </option>
										<option value="فلسطين">فلسطين</option>
										<option value="إيطاليا">إيطاليا</option>
										<option value="جامايكا">جامايكا</option>
										<option value="اليابان">اليابان</option>
										<option value="الأردن">الأردن</option>
										<option value="كازاخستان">كازاخستان</option>
										<option value="كينيا">كينيا</option>
										<option value="كيريباتي">كيريباتي</option>
										<option value="الكويت">الكويت</option>
										<option value="قرغيزستان">قرغيزستان</option>
										<option value="لاوس">لاوس</option>
										<option value="لاوس">لاوس</option>
										<option value="لاتفيا">لاتفيا</option>
										<option value="لبنان">لبنان</option>
										<option value="ليسوتو">ليسوتو</option>
										<option value="ليبيريا">ليبيريا</option>
										<option value="ليبيا">ليبيا</option>
										<option value="ليختنشتاين">ليختنشتاين</option>
										<option value="ليتوانيا">ليتوانيا</option>
										<option value="لوكسمبورغ">لوكسمبورغ</option>
										<option value="مدغشقر">مدغشقر</option>
										<option value="مالاوي">مالاوي</option>
										<option value="ماليزيا">ماليزيا</option>
										<option value="جزر المالديف">جزر المالديف</option>
										<option value="مالي">مالي</option>
										<option value="مالطا">مالطا</option>
										<option value="جزر مارشال">جزر مارشال</option>
										<option value="موريتانيا">موريتانيا</option>
										<option value="موريشيوس">موريشيوس</option>
										<option value="المكسيك">المكسيك</option>
										<option value="مايكرونيزيا">مايكرونيزيا</option>
										<option value="مولدوفا">مولدوفا</option>
										<option value="موناكو">موناكو</option>
										<option value="منغوليا">منغوليا</option>
										<option value="الجبل الأسود">الجبل الأسود</option>
										<option value="المغرب">المغرب</option>
										<option value="موزمبيق">موزمبيق</option>
										<option value="بورما">بورما</option>
										<option value="ناميبيا">ناميبيا</option>
										<option value="ناورو">ناورو</option>
										<option value="نيبال">نيبال</option>
										<option value="هولندا">هولندا</option>
										<option value="نيوزيلندا">نيوزيلندا</option>
										<option value="نيكاراجوا">نيكاراجوا</option>
										<option value="النيجر">النيجر</option>
										<option value="نيجيريا">نيجيريا</option>
										<option value="كوريا الشمالية ">كوريا الشمالية </option>
										<option value="النرويج">النرويج</option>
										<option value="سلطنة عمان">سلطنة عمان</option>
										<option value="باكستان">باكستان</option>
										<option value="بالاو">بالاو</option>
										<option value="بنما">بنما</option>
										<option value="بابوا غينيا الجديدة">بابوا غينيا الجديدة</option>
										<option value="باراغواي">باراغواي</option>
										<option value="بيرو">بيرو</option>
										<option value="الفلبين">الفلبين</option>
										<option value="بولندا">بولندا</option>
										<option value="البرتغال">البرتغال</option>
										<option value="قطر">قطر</option>
										<option value="جمهورية الكونغو">جمهورية الكونغو</option>
										<option value="جمهورية مقدونيا">جمهورية مقدونيا</option>
										<option value="رومانيا">رومانيا</option>
										<option value="روسيا">روسيا</option>
										<option value="رواندا">رواندا</option>
										<option value="سانت كيتس ونيفيس">سانت كيتس ونيفيس</option>
										<option value="سانت لوسيا">سانت لوسيا</option>
										<option value="سانت فنسينت والجرينادينز">سانت فنسينت والجرينادينز</option>
										<option value="ساموا">ساموا</option>
										<option value="سان مارينو">سان مارينو</option>
										<option value="ساو تومي وبرينسيب">ساو تومي وبرينسيب</option>
										<option value="السعودية">السعودية</option>
										<option value="السنغال">السنغال</option>
										<option value="صربيا">صربيا</option>
										<option value="سيشيل">سيشيل</option>
										<option value="سيراليون">سيراليون</option>
										<option value="سنغافورة">سنغافورة</option>
										<option value="سلوفاكيا">سلوفاكيا</option>
										<option value="سلوفينيا">سلوفينيا</option>
										<option value="جزر سليمان">جزر سليمان</option>
										<option value="الصومال">الصومال</option>
										<option value="جنوب أفريقيا">جنوب أفريقيا</option>
										<option value="كوريا الجنوبية">كوريا الجنوبية</option>
										<option value="جنوب السودان">جنوب السودان</option>
										<option value="إسبانيا">إسبانيا</option>
										<option value="سريلانكا">سريلانكا</option>
										<option value="السودان">السودان</option>
										<option value="سورينام">سورينام</option>
										<option value="سوازيلاند">سوازيلاند</option>
										<option value="السويد">السويد</option>
										<option value="سويسرا">سويسرا</option>
										<option value="سوريا">سوريا</option>
										<option value="طاجيكستان">طاجيكستان</option>
										<option value="تنزانيا">تنزانيا</option>
										<option value="تايلاند">تايلاند</option>
										<option value="توغو">توغو</option>
										<option value="تونجا">تونجا</option>
										<option value="ترينيداد وتوباغو">ترينيداد وتوباغو</option>
										<option value="تونس">تونس</option>
										<option value="تركيا">تركيا</option>
										<option value="تركمانستان">تركمانستان</option>
										<option value="توفالو">توفالو</option>
										<option value="أوغندا">أوغندا</option>
										<option value="أوكرانيا">أوكرانيا</option>
										<option value="الإمارات العربية المتحدة">الإمارات العربية المتحدة</option>
										<option value="المملكة المتحدة">المملكة المتحدة</option>
										<option value="الولايات المتحدة">الولايات المتحدة</option>
										<option value="أوروغواي">أوروغواي</option>
										<option value="أوزبكستان">أوزبكستان</option>
										<option value="فانواتو">فانواتو</option>
										<option value="فنزويلا">فنزويلا</option>
										<option value="فيتنام">فيتنام</option>
										<option value="اليمن">اليمن</option>
										<option value="زامبيا">زامبيا</option>
										<option value="زيمبابوي">زيمبابوي</option>
									  </select>
								</div>
								<div class="form-group">
									<label for="text">عدد العنابر</label>
									<input type="number" class="form-control" id="gate_number" name="gate_number" min="1">
								</div>
								<div class="form-group">
									<label for="text">أبعاد السفينة</label>
									<input type="text" class="form-control" id="ship_dimensions" name="ship_dimensions">
								</div>
								<div class="form-group">
									<label for="text">سعة السفينة</label>
									<input type="number" class="form-control" id="ship_capacity" name="ship_capacity" min="1" required>
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
{{--    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>--}}
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var ship_name = button.data('ship_name')
            var country = button.data('country')
			var gate_number = button.data('gate_number')
			var ship_dimensions = button.data('ship_dimensions')
			var ship_capacity = button.data('ship_capacity')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #ship_name').val(ship_name);
            modal.find('.modal-body #country').val(country);
			modal.find('.modal-body #gate_number').val(gate_number);
			modal.find('.modal-body #ship_dimensions').val(ship_dimensions);
			modal.find('.modal-body #ship_capacity').val(ship_capacity);
        })
    </script>
@endsection
