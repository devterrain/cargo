<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'الرئيسية',
            'إضافة سيارات',
            'تعديل سيارات',
            'حذف سيارات',
            'إضافة مقطورات',
            'تعديل مقطورات',
            'حذف مقطورات',
            'إضافة سائقين',
            'تعديل سائقين',
            'حذف سائقين',
            'إضافة صنف',
            'إضافة منتج',
            'إضافة بضائع',
            'إضافة موانئ شحن',
            'إضافة مصانع وجهات تحميل',
            'إضافة وجهات وصول',
            'إضافة مخازن',
            'إضافة سفينة',
            'إضافة معدات تحميل',
            'إضافة سيور رفع',
            'إضافة أرصفة ارساء',
            'إضافة مقاول نقل',
            'إضافة مقاول شحن',
            'إضافة رحلة سفينة',
            'تعديل رحلة سفينة',
            'حذف رحلة سفينة',
            'إضافة رقم افراج',
            'تعديل رقم افراج',
            'حذف رقم افراج',
            'إضافة مشغلين معدات',
            'تعديل مشغلين معدات',
            'حذف مشغلين معدات',
            'تحرير بوليصة شحن',
            'حذف بوليصة شحن',
            'تعديل بوليصة شحن',
            'طباعة بوليصة شحن',
            'المستخدمين',
            'قائمة المستخدمين',
            'صلاحيات المستخدمين',
            'إعداد الدرافت',
            'عمليات نقل البضائع',
            'الوزن الفارغ',
            'انتظار التخزين',
            'انهاء التخزين',
            'نقل من المخزن إلى الرصيف',
            'عمليات الشحن',
            'عمليات الشحن قيد التنفيذ',
            'نقل من مخزن إلى مخزن',
            'إعادة توجيه',
            'تعديل عمليات',
            'إلغاء عمليات',
            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',
            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',
            'عرض تقارير',
            'تقرير النقل والتخزين',
            'تقرير عمليات التخزين',
            'تقرير شحن السفن'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
