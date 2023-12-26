<?php

use App\Models\BusinessDay;
use App\Models\Customer;
use App\Models\Room;
use App\Models\SystemDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

if (!function_exists('do_money')) {
    /**
     * do_money
     *
     * @return string
     */
    function do_money($amount)
    {
        return '₦' . number_format($amount, 2);
    }
}

if (!function_exists('systemDetails')) {
    /**
     * systemDetails
     *
     * @return array
     */
    function systemDetails()
    {
        $data = SystemDetail::find(1);
        $system['name'] = $data->name;
        $system['mobile'] = $data->mobile;
        $system['logo'] = asset('Logo/' . $data->logo);
        $system['version'] = '1.0';
        return $system;
    }
}

if (!function_exists('businessDay')) {
    /**
     * systemDetails
     *
     * @return array || object
     */
    function businessDay()
    {
        $data = BusinessDay::where('status', 1)->first();
        return $data;
    }
}

function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}

function toLower($string)
{
    return Illuminate\Support\Str::lower($string);
}

function shortDescription($string, $length = 120)
{
    return Illuminate\Support\Str::limit($string, $length);
}

function shortCodeReplacer($shortCode, $replace_with, $template_string)
{
    return str_replace($shortCode, $replace_with, $template_string);
}

function verificationCode($length)
{
    if ($length == 0) {
        return 0;
    }
    $min = pow(10, $length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = $max * 10 + 9;
    }
    return random_int($min, $max);
}

function getNumber($length = 8)
{
    $characters = '1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//moveable
function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{
    $path = makeDirectory($location);
    if (!$path) {
        throw new Exception('File could not been created.');
    }

    if ($old) {
        removeFile($location . '/' . $old);
        removeFile($location . '/thumb_' . $old);
    }
    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $image = Image::make($file);
    if ($size) {
        $size = explode('x', strtolower($size));
        $image->resize($size[0], $size[1]);
    }
    $image->save($location . '/' . $filename);

    if ($thumb) {
        $thumb = explode('x', $thumb);
        Image::make($file)
            ->resize($thumb[0], $thumb[1])
            ->save($location . '/thumb_' . $filename);
    }

    return $filename;
}

function uploadFile($file, $location, $size = null, $old = null)
{
    $path = makeDirectory($location);
    if (!$path) {
        throw new Exception('File could not been created.');
    }

    if ($old) {
        removeFile($location . '/' . $old);
    }

    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $file->move($location, $filename);
    return $filename;
}

function makeDirectory($path)
{
    if (file_exists($path)) {
        return true;
    }
    return mkdir($path, 0755, true);
}

function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

function getTrx($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getAmount($amount, $length = 2)
{
    $amount = round($amount, $length);
    return $amount + 0;
}

function showAmount($amount, $decimal = 2, $separate = true, $exceptZeros = false)
{
    $separator = '';
    if ($separate) {
        $separator = ',';
    }
    $printAmount = number_format($amount, $decimal, '.', $separator);
    if ($exceptZeros) {
        $exp = explode('.', $printAmount);
        if ($exp[1] * 1 == 0) {
            $printAmount = $exp[0];
        }
    }
    return $printAmount;
}

function removeElement($array, $value)
{
    return array_diff($array, is_array($value) ? $value : [$value]);
}

//moveable
function curlContent($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//moveable
function curlPostContent($url, $arr = null)
{
    if ($arr) {
        $params = http_build_query($arr);
    } else {
        $params = '';
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function inputTitle($text)
{
    return ucfirst(preg_replace('/[^A-Za-z0-9 ]/', ' ', $text));
}

function titleToKey($text)
{
    return strtolower(str_replace(' ', '_', $text));
}

function str_limit($title = null, $length = 10)
{
    return \Illuminate\Support\Str::limit($title, $length);
}

//moveable
function getIpInfo()
{
    $ip = $_SERVER['REMOTE_ADDR'];

    //Deep detect ip
    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }

    $xml = @simplexml_load_file('http://www.geoplugin.net/xml.gp?ip=' . $ip);

    $country = @$xml->geoplugin_countryName;
    $city = @$xml->geoplugin_city;
    $area = @$xml->geoplugin_areaCode;
    $code = @$xml->geoplugin_countryCode;
    $long = @$xml->geoplugin_longitude;
    $lat = @$xml->geoplugin_latitude;

    $data['country'] = $country;
    $data['city'] = $city;
    $data['area'] = $area;
    $data['code'] = $code;
    $data['long'] = $long;
    $data['lat'] = $lat;
    $data['ip'] = request()->ip();
    $data['time'] = date('d-m-Y h:i:s A');

    return $data;
}

//moveable
function osBrowser()
{
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $osPlatform = 'Unknown OS Platform';
    $osArray = [
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile',
    ];
    foreach ($osArray as $regex => $value) {
        if (preg_match($regex, $userAgent)) {
            $osPlatform = $value;
        }
    }
    $browser = 'Unknown Browser';
    $browserArray = [
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser',
    ];
    foreach ($browserArray as $regex => $value) {
        if (preg_match($regex, $userAgent)) {
            $browser = $value;
        }
    }

    $data['os_platform'] = $osPlatform;
    $data['browser'] = $browser;

    return $data;
}

function getImage($image, $path = null, $size = null)
{
    $clean = '';
    if (!$path) {
        $path = '/Avatar/';
    }
    $imagePath = $path . $image;
    if (file_exists($imagePath) && is_file($imagePath)) {
        return asset($imagePath);
    }
    if ($size) {
        return route('placeholder.image', $size);
    }
    return asset('assets/images/users/user-4.jpg');
}

function sendPhpMail($receiver_email, $receiver_name, $subject, $message, $general)
{
    $headers = "From: $general->sitename <$general->email_from> \r\n";
    $headers .= "Reply-To: $general->sitename <$general->email_from> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    @mail($receiver_email, $subject, $message, $headers);
}

function getPaginate($paginate = 20)
{
    return $paginate;
}

function diffForHumans($date)
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->diffForHumans();
}

function showDateTime($date, $format = 'Y-m-d h:i A')
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}

function urlPath($routeName, $routeParam = null)
{
    if ($routeParam == null) {
        $url = route($routeName);
    } else {
        $url = route($routeName, $routeParam);
    }
    $basePath = route('home');
    $path = str_replace($basePath, '', $url);
    return $path;
}

function ratingStar($rating = 0)
{
    $ratingStar = '';

    for ($i = 0; $i < floor($rating); $i++) {
        $ratingStar .= '<li class="as-rating-list__item">
                            <span class="as-rating-icon as-rating-icon--xl">
                                <i class="fas fa-star"></i>
                            </span>
                        </li>';
    }

    if (0 < $rating - floor($rating) && $rating - floor($rating) <= 0.25) {
        $ratingStar .= '<li class="as-rating-list__item">
                            <span class="as-rating-icon as-rating-icon--xl as-rating-icon--disable">
                                <i class="fas fa-star"></i>
                            </span>
                        </li>';
    } elseif (0.25 < $rating - floor($rating) && $rating - floor($rating) <= 0.75) {
        $ratingStar .= '<li class="as-rating-list__item">
                            <span class="as-rating-icon as-rating-icon--half as-rating-icon--xl">
                                <i class="fas fa-star-half-alt"></i>
                            </span>
                        </li>';
    } elseif (0.75 <= $rating - floor($rating) && $rating - floor($rating) < 1) {
        $ratingStar .= '<li class="as-rating-list__item">
                            <span class="as-rating-icon as-rating-icon--xl">
                                <i class="fas fa-star"></i>
                            </span>
                        </li>';
    }

    for ($i = 0; $i < 5 - ceil($rating); $i++) {
        $ratingStar .= '<li class="as-rating-list__item">
                            <span class="as-rating-icon as-rating-icon--xl as-rating-icon--disable">
                                <i class="fas fa-star"></i>
                            </span>
                        </li>';
    }

    return $ratingStar;
}

function paymentType()
{
    $lists = ['Cash', 'POS', 'Transfer', 'Cash,POS', 'Transfer,Cash', 'Transfer,POS', 'Transfer,Cash,POS', 'Complimentary'];
    return $lists;
}

function getUser($id)
{
    $user = User::find($id);
    if (!$user) {
        return false;
    }
    return $user;
}

function getRoom($id)
{
    $room = Room::find($id);
    if (!$room) {
        return false;
    }
    return $room;
}

function getCustomer($id)
{
    $customer = Customer::find($id);
    if (!$customer) {
        return false;
    }
    return $customer;
}
