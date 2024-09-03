<?php

use App\Models\TransactionLog;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

function saveImage($destination, $attribute, $width = null, $height = null): string
{
    if (!File::isDirectory(base_path() . '/public/uploads/' . $destination)) {
        File::makeDirectory(base_path() . '/public/uploads/' . $destination, 0777, true, true);
    }

    if ($attribute->extension() == 'svg') {
        $file_name = time() . '-' . $attribute->getClientOriginalName();
        $path = 'uploads/' . $destination . '/' . $file_name;
        $attribute->move(public_path('uploads/' . $destination . '/'), $file_name);
        return $path;
    }

    $img = Image::make($attribute);
    if ($width != null && $height != null && is_int($width) && is_int($height)) {
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
    }

    $returnPath = 'uploads/' . $destination . '/' . time() . '-' . Str::random(10) . '.' . $attribute->extension();
    $savePath = base_path() . '/public/' . $returnPath;
    $img->save($savePath);
    return $returnPath;
}


function saveFile($destination, $attribute): string
{
    if (!File::isDirectory(base_path() . '/public/uploads/' . $destination)) {
        File::makeDirectory(base_path() . '/public/uploads/' . $destination, 0777, true, true);
    }

    $file_name = time() . '-' . $attribute->getClientOriginalName();
    $path = 'uploads/' . $destination . '/' . $file_name;
    $attribute->move(public_path('uploads/' . $destination . '/'), $file_name);
    return $path;
}


function deleteFile($path)
{
    File::delete($path);
}

function getFile($file)
{
    return asset($file);
}
function e_to_b($data)
{
    $dictionary_data = dictionary_data();
    $converted = strtr($data, $dictionary_data);
    return $converted;
}
function e2b($data)
{
    $dictionary_data = dictionary_data();
    $converted = strtr($data, $dictionary_data);
    return $converted;
}
function dictionary_data()
{
    $data = [
        'Building' => 'ভবন',
        'Semi-tin Seed' => 'আধা টিন সেড',
        'Tin Seed' => 'টিন সেড',
        'Yes' => 'হ্যাঁ',
        'No' => 'না',
        'Active' => 'সক্রিয়',
        'Inactive' => 'নিষ্ক্রিয়',
        'Monthly' => 'মাসিক',
        'Yearly' => 'বাৎসরিক',
        1 => '১',
        2 => '২',
        3 => '৩',
        4 => '৪',
        5 => '৫',
        6 => '৬',
        7 => '৭',
        8 => '৮',
        9 => '৯',
        0 => '০',
        'one' => 'এক',
        'two' => 'দুই',
        'three' => 'তিন',
        'four' => 'চার',
        'five' => 'পাঁচ',
        'six' => 'ছয়',
        'seven' => 'সাত',
        'eight' => 'আট',
        'nine' => 'নয়',
        'ten' => 'দশ',
        'zero' => 'শূন্য',
        'hundred' => 'শত',
        'thousand' => 'হাজার',
        'Friday' => 'শুক্রবার',
        'Saturday' => 'শনিবার',
        'Sunday' => 'রবিবার',
        'Monday' => 'সোমবার',
        'Tuesday' => 'মঙ্গলবার',
        'Wednesday' => 'বুধবার',
        'Thursday' => 'বৃহস্পতিবার',
        'January' => 'জানুয়ারী',
        'February' => 'ফেব্রুয়ারি',
        'March' => 'মার্চ',
        'April' => 'এপ্রিল',
        'May' => 'মে',
        'June' => 'জুন',
        'July' => 'জুলাই',
        'August' => 'অগাস্ট',
        'September' => 'সেপ্টেম্বর',
        'October' => 'অক্টোবর',
        'November' => 'নভেম্বর',
        'December' => 'ডিসেম্বর',
        'Applied' => 'ফলিত',
        'On Review' => 'পর্যালোচনা',
        'Pending' => 'মুলতুবি',
        'Granted' => 'অনুমোদিত',
        'Correction' => 'সংশোধন',
        'Cancel' => 'বাতিল',
        'Bank draft' => 'পে অর্ডার / ব্যাংক ড্রাফট',
        'Bkash' => 'বিকাশ',
        'Nagat' => 'নগদ',
        'dollars' => 'টাকা',
        'Alfadanga' => 'আলফাডাঙ্গা',
        'Bhanga' => 'ভাঙ্গা',
        'Boalmari' => 'বোয়ালমারী',
        'Charbhadrasan' => 'চরভদ্রাসন',
        'Faridpur Sadar' => 'ফরিদপুর সদর',
        'Madukhali' => 'মধুখালী',
        'Nagarkanda' => 'নগরকান্দা',
        'Sadarpur' => 'সদরপুর',
        'Shriangan' => 'শারিঙ্গন',
        'New' => 'নতুন',
        'Renewal' => 'নবায়ন',
        'Renew' => 'নবায়ন',
        'Proprietorship' => 'প্রোপ্রিয়েটরশীপ',
        'Partnerships' => 'পার্টনারশীপ',
        'Private Ltd' => 'প্রাইভেট লিঃ',
        'Bridge' => 'পূর্ত ( নির্মাণ, সংস্কার, কায়িক  সেবা )',
        'Mechanical' => 'যান্ত্রিক',
        'Electrical' => 'ইলেক্ট্রিক্যাল',
        'Agriculture' => 'কৃষি',
        'Commercial' => 'বাণিজ্যিক',
        'Residential' => 'আবাসিক',
        'Other' => 'অন্যান্য',
        'Transfer' => 'হস্তান্তর',
        'Gangni' => 'গাংনী',
        'Mujibnagar' => 'মুজিবনগর',
        'Meherpur Sadar' => 'মেহেরপুর সদর',
        'Shotangsho' => ' শতাংশ',
        'Sq Feet' => ' বর্গফুট',
        'bn' => ' বাংলা',
        'en' => ' ইংরেজি',
        'Rocket' => ' রকেট',
        'bKash' => '  বিকেশ',
        'Cash' => '   ক্যাশ',
        'Processing' => 'প্রক্রিয়াকরণ',
        'Ready for delivery' => 'সরবরাহের জন্য প্রস্তুত',
        'Delivery successful' => 'বিতরণ সফল',
        'Male' => 'পুরুষ',
        'Female' => 'মহিলা',
        'Others' => 'অন্যান্য',
        'Father' => 'পিতা',
        'Mother' => 'মাতা',
        'Husband' => 'স্বামী',
        'Wife' => 'স্ত্রী',
        'Son' => 'পুত্র',
        'Daughter' => 'কন্যা',
        'Brother' => 'ভাই',
        'Sister' => 'বোন',
        'Married' => 'বিবাহিত',
        'Unmarried' => 'অবিবাহিত',
        'Divorced' => 'তালাকপ্রাপ্ত',
        'Widowed' => 'বিধবা',



    ];

    return $data;
}

function profile_field()
{
    // $columns = Schema::getColumnListing('users'); // Replace 'users' with your table name
    // dd($columns);
    // foreach ($columns as $column) {
    //     echo $column . '<br>';
    // }
    return [
        1 => ['Name' => 'নাম', 'key' => 'name'],
        2 => ['Name' => 'Email', 'key' => 'email'],
        3 => ['Name' => 'পিতার নাম', 'key' => 'father_name'],
        4 => ['Name' => 'মাতার নাম', 'key' => 'mother_name'],
        5 => ['Name' => 'National ID', 'key' => 'nid'],
        6 => ['Name' => 'Birth Certificate No', 'key' => 'birth_certificate_no'],
        7 => ['Name' => 'Gender', 'key' => 'gender'],
        8 => ['Name' => 'Religion', 'key' => 'religion'],
        9 => ['Name' => 'Marital Status', 'key' => 'marital_status'],
        10 => ['Name' => 'Birthday', 'key' => 'date_of_birth'],
        11 => ['Name' => 'Present Division', 'key' => 'division_id'],
        12 => ['Name' => 'Present District', 'key' => 'district_id'],
        13 => ['Name' => 'Present Upazila', 'key' => 'sub_district_id'],
        14 => ['Name' => 'Present Union', 'key' => 'union_id'],
        15 => ['Name' => 'Present Ward', 'key' => 'ward_id'],
        16 => ['Name' => 'Present Moholla', 'key' => 'moholla_id'],
        17 => ['Name' => 'Present Post Office', 'key' => 'post_office_id'],

        18 => ['Name' => 'Permanent Division', 'key' => 'per_division_id'],
        19 => ['Name' => 'Permanent District', 'key' => 'per_district_id'],
        20 => ['Name' => 'Permanent Upazila', 'key' => 'per_sub_district_id'],
        21 => ['Name' => 'Permanent Union', 'key' => 'per_union_id'],
        22 => ['Name' => 'Permanent Ward', 'key' => 'per_ward_id'],
        23 => ['Name' => 'Permanent Moholla', 'key' => 'per_moholla_id'],
        24 => ['Name' => 'Permanent Post Office', 'key' => 'per_post_office_id'],
    ];
}
function lv_warishtype()
{

    return [
        'Father' => 'পিতা',
        'Mother' => 'মাতা',
        'Husband' => 'স্বামী',
        'Wife' => 'স্ত্রী',
        'Son' => 'পুত্র',
        'Daughter' => 'কন্যা',
        'Brother' => 'ভাই',
        'Sister' => 'বোন'
    ];
}
function lv_key_last($array)
{
    $key = NULL;

    if (is_array($array)) {

        end($array);
        $key = key($array);
    }

    return $key;
}
function btnStatus($data)
{

    if ($data == 'Pending') {
        return 'btn-info';
    } elseif ($data == 'Approved') {
        return 'btn-success';
    } elseif ($data == 'Modification') {
        return 'btn-warning';
    } elseif ($data == 'Canceled') {
        return 'btn-danger';
    } else {
        return 'btn-default';
    }
}
function bn2enNumber($number)
{
    $search_array = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', '-'];
    $replace_array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '-'];
    $en_number = str_replace($replace_array, $search_array, $number);
    return $en_number;
}

function paymentHistory()
{

    $total_register = TransactionLog::where(['is_active' => 'Yes'])->get();
    $total_register = $total_register->count();

    $today_register = TransactionLog::whereDate('created_at', '=', date('Y-m-d'))->get();
    $today_register = $today_register->count();


    $today_income = TransactionLog::where(['is_active' => 'Yes'])
        ->whereDate('created_at', '=', date('Y-m-d'))->get();
    $total_income = TransactionLog::where(['is_active' => 'Yes'])->get();

    $today_income_up = TransactionLog::where(['is_active' => 'Yes'])
        ->whereDate('created_at', '=', date('Y-m-d'))->get();
    $total_income_up = TransactionLog::all();

    $income_up = $total_income_up->sum('amount');
    $up_paid =  TransactionLog::where(['is_active' => 'Yes'])->get()->sum('amount');


    $result = [
        'total_register' => $total_register,
        'today_register' => $today_register,
        'total_income' => $total_income->sum('amount'),
        'today_income' => $today_income->sum('amount'),
        'total_income_up' => $income_up,
        'today_income_up' => $today_income_up->sum('amount'),
        'up_paid' => $up_paid,
        'up_due' => $income_up - $up_paid,
    ];
    //dd($result);
    return $result;
}

function pendding_payment_count($id = null)
{
    if (auth()->user()->isDigitalCenter()) {
        $pending_payment = TransactionLog::where(['is_active' => 'No'])->get()->count();
    } else {
        $pending_payment = TransactionLog::where(['is_active' => 'No'])->get()->count();
    }

    if ($pending_payment > 0 && $pending_payment < 10) {
        $data = $pending_payment;
    } elseif ($pending_payment > 9) {
        $data = '9+';
    } else {
        $data = false;
    }
    return $data;
}
