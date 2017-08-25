<?php

if (!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        return Request::is($path) ? ' class="active"' : '';
    }
}

if (!function_exists('classActiveSegment')) {
    function classActiveSegment($segment, $value)
    {
        if(!is_array($value)) {
            return Request::segment($segment) == $value ? ' class="active"' : '';
        }
        foreach ($value as $v) {
            if(Request::segment($segment) == $v) return ' class="active"';
        }
        return '';
    }
}

if (!function_exists('classActiveOnlyPath')) {
    function classActiveOnlyPath($path)
    {
        return Request::is($path) ? ' active' : '';
    }
}

if (!function_exists('classActiveOnlySegment')) {
    function classActiveOnlySegment($segment, $value)
    {
        if(!is_array($value)) {
            return Request::segment($segment) == $value ? ' active' : '';
        }
        foreach ($value as $v) {
            if(Request::segment($segment) == $v) return ' active';
        }
        return '';
    }
}


if (!function_exists('get_user')) {
    function get_user()
    {

        $sent_user = Sentinel::getUser();
        if ($sent_user) {
           /* $user = \Cache::remember('user_'.$sent_user->id, 20,function () use($sent_user) {
                return \App\Models\User::find($sent_user->id);
            });*/

            $user = \App\Models\User::find($sent_user->id);

            if ($user) {
                return $user;
            }
        }

        return false;
    }
}

if (!function_exists('get_banner_sizes')) {
    function get_banner_sizes()
    {

       $arr = [
           '120x60' => '120x60',
           '120x90' => '120x90',
           '120x240' => '120x240',
           '120x600' => '120x600',
           '125x125' => '125x125',
           '160x600' => '160x600',
           '180x150' => '180x150',
           '200x300' => '200x300',
           '234x60' => '234x60',
           '240x400' => '240x400',
           '250x250' => '250x250',
           '300x50' => '300x50',
           '300x100' => '300x100',
           '300x250' => '300x250',
           '300x600' => '300x600',
           '318x106' => '318x106',
           '320x480' => '320x480',
           '320x50' => '320x50',
           '336x280' => '336x280',
           '468х60' => '468х60',
           '500x500' => '500x500',
           '600x200' => '600x200',
           '600x300' => '600x300',
           '600x350' => '600x350',
           '720x300' => '720x300',
           '728x90' => '728x90',
           '1000x600' => '1000x600',

       ];

        return $arr;
    }
}

if (!function_exists('showDate')) {
    function showDate($date, $ago = null) // $date --> время в формате Unix time
    {
        $stf = 0;
        $cur_time = time();
        $diff = $cur_time - $date;

        $seconds = array('second', 'second', 'seconds');
        $minutes = array('minute', 'minutes', 'minutes');
        $hours = array('hour', 'hours', 'hours');
        $days = array('day', 'day', 'days');
        $weeks = array('week', 'weeks', 'weeks');
        $months = array('month', 'month', 'months');
        $years = array('year', 'year', 'years');
        $decades = array('decade', 'decade', 'decades');

        $phrase = array($seconds, $minutes, $hours, $days, $weeks, $months, $years, $decades);
        $length = array(1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600);

        for ($i = sizeof($length) - 1; ($i >= 0) && (($no = $diff / $length[$i]) <= 1); $i--) {
            ;
        }
        if ($i < 0) {
            $i = 0;
        }
        $_time = $cur_time - ($diff % $length[$i]);
        $no = floor($no);
        $value = sprintf("%d %s ", $no, getPhrase($no, $phrase[$i]));

        if (($stf == 1) && ($i >= 1) && (($cur_time - $_time) > 0)) {
            $value .= time_ago($_time);
        }

        return ($ago) ? $value . ' ago' : $value;
    }
}
if (!function_exists('getPhrase')) {
    function getPhrase($number, $titles)
    {
        $cases = array(2, 0, 1, 1, 1, 2);

        return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
    }
}

if (!function_exists('setting')) {
    function setting($name)
    {

            //$setting = \App\Setting::where('name', '=', $name)->first();
            $setting = \Cache::remember('settings_'.$name, 60, function () use ($name) {
                return \App\Models\Setting::where('name', '=', $name)->first();
            });

            if ($setting) {

                if ($name == 'email_admin') {
                    return preg_split('/,/', $setting->value, -1, PREG_SPLIT_NO_EMPTY);
                }

                return $setting->value;
            }


        return false;
    }
}


if (!function_exists('strcode')) {
    function strcode($str, $passw = "")
    {
        $salt = "Dn8*#2n!9j";
        $len = strlen($str);
        $gamma = '';
        $n = $len > 100 ? 8 : 2;
        while (strlen($gamma) < $len) {
            $gamma .= substr(pack('H*', sha1($passw . $gamma . $salt)), 0, $n);
        }
        return $str ^ $gamma;
    }
}


if (!function_exists('generate_banner_code')) {
    /**
     * @param int $banner_id
     * @param int $adv_company_id
     * @param string $promocode
     * @param string $link
     * @param string $alt
     * @return string
     */
    function generate_banner_code($banner_id, $adv_company_id, $link, $alt = '')
    {
        $link_key = generate_banner_ref_key($banner_id, $adv_company_id);
        $click_key = generate_banner_ref_key($banner_id, $adv_company_id);
        return '<a href="'.route('bannerClickProcess', base64_encode($banner_id.'&r='.$click_key) ).'" target="_blank"><img src="'.url('/show?image='.base64_encode($banner_id.'&r='.$link_key.'&link='.$link)).'" alt="'.$alt.'"/></a>';
    }
}


if (!function_exists('generate_banner_ref_key')) {
    /**
     * @param $banner_id
     * @param $adv_company_id
     * @param $promocode
     * @return string
     */
    function generate_banner_ref_key($banner_id, $adv_company_id)
    {
        return urlencode(base64_encode(strcode('bid='.$banner_id.'&aid='.$adv_company_id, 'bloggersclub')));
    }
}


if (!function_exists('generate_text_code')) {

    function generate_text_code($text = '', $replacement = [])
    {
        $keys = [];
        $values = [];

        foreach ($replacement as $key => $value) {
            $keys[] = '{{'.$key.'}}';
            $values[] = $value;
        }

        return str_replace($keys, $values, $text);
    }
}

if (!function_exists('generate_reflink_code')) {

    function generate_reflink_code($blogger_link_id, $adv_company_id, $user_id)
    {
        return  base64url_encode( strcode('lid='.$blogger_link_id.'&aid='.$adv_company_id.'&uid='.$user_id, 'bloggersclub') );
    }
}



if (!function_exists('rus2translit')) {
    function rus2translit($string)
    {

        /*
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
            'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
            'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => '', 'ы' => 'y', 'ъ' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            'А' => 'a', 'Б' => 'b', 'В' => 'v',
            'Г' => 'g', 'Д' => 'd', 'Е' => 'e',
            'Ё' => 'e', 'Ж' => 'zh', 'З' => 'z',
            'И' => 'i', 'Й' => 'y', 'К' => 'k',
            'Л' => 'l', 'М' => 'm', 'Н' => 'n',
            'О' => 'o', 'П' => 'p', 'Р' => 'r',
            'С' => 's', 'Т' => 't', 'У' => 'u',
            'Ф' => 'f', 'Х' => 'h', 'Ц' => 'c',
            'Ч' => 'ch', 'Ш' => 'sh', 'Щ' => 'sch',
            'Ь' => '', 'Ы' => 'y', 'Ъ' => '',
            'Э' => 'e', 'Ю' => 'yu', 'Я' => 'ya',
        );
*/
        $converter = array(
            "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
            "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
            "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
            "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
            "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
            "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
            "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
            "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
            "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
            "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
            "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
            "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
            "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"
        );

        return strtr($string, $converter);
    }
}

if (!function_exists('str2url')) {
    function str2url($str) {
        // переводим в транслит
        $str = rus2translit($str);
        // в нижний регистр
        $str = mb_strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return $str;
    }
}


if (!function_exists('base64url_encode')) {
    function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}
if (!function_exists('base64url_decode')) {
    function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}
