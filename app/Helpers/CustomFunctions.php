<?php

if (!function_exists('setUserTheme')) {
    function setUserTheme($theme)
    {
        $classes = [
            'default' => [
                'body' => '',
                'nav' => ' navbar-light ',
                'sidebar' => 'sidebar-dark-primary ',
            ],
            'light' => [
                'body' => '',
                'nav' => ' navbar-white ',
                'sidebar' => ' sidebar-light-lightblue '
            ],
            'dark' => [
                'body' => ' dark-mode ',
                'nav' => ' navbar-dark ',
                'sidebar' => ' sidebar-dark-secondary '
            ]
        ];
        return $classes[$theme] ?? [
            'body' => '',
            'nav' => ' navbar-light ',
            'sidebar' => 'sidebar-dark-primary ',
        ];
    }
}

if (!function_exists('price_format')) {
    function price_format($price)
    {
        return number_format($price, 2, ".", " ");
    }
}
if (!function_exists('nf')) {
    function nf($number)
    {
        return number_format($number, 0, "", " ");
    }
}

if (!function_exists('convert_text_kril')) {
    function convert_text_kril($text)
    {
        $cyr = [
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
            'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р', 'С', 'Т', 'У', 'Ў', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
        ];
        $lat = [
            'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'j', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sh', 'a', 'i', 'y', 'e', 'yu', 'ya',
            'A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'J', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P',
            'R', 'S', 'T', 'U', 'O', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sh', 'A', 'I', 'Y', 'e', 'Yu', 'Ya'
        ];
        $textlat = mb_strtoupper(removeChars(str_replace( $lat,$cyr, $text)));
        return $textlat;
    }
}

if (!function_exists('cyrillicText')) {
    function cyrillicText($text)
    {
        $translation = array(
            'a' => 'а', 'b' => 'б', 'c' => 'ц', 'd' => 'д', 'e' => 'е', 'f' => 'ф',
            'g' => 'г', 'h' => 'һ', 'i' => 'и', 'j' => 'ж', 'k' => 'к', 'l' => 'л',
            'm' => 'м', 'n' => 'н', 'o' => 'о', 'p' => 'п', 'q' => 'қ', 'r' => 'р',
            's' => 'с', 't' => 'т', 'u' => 'у', 'v' => 'в', 'w' => 'в', 'x' => 'х',
            'y' => 'й', 'z' => 'з',
            'A' => 'А', 'B' => 'Б', 'C' => 'Ц', 'D' => 'Д', 'E' => 'Е', 'F' => 'Ф',
            'G' => 'Г', 'H' => 'Һ', 'I' => 'И', 'J' => 'Ж', 'K' => 'К', 'L' => 'Л',
            'M' => 'М', 'N' => 'Н', 'O' => 'О', 'P' => 'П', 'Q' => 'Қ', 'R' => 'Р',
            'S' => 'С', 'T' => 'Т', 'U' => 'У', 'V' => 'В', 'W' => 'В', 'X' => 'Х',
            'Y' => 'Й', 'Z' => 'З'
        );
        return strtr($text, $translation);
    }
}
function convertText($text){
    return preg_match('/[А-Яа-я]/u', $text) === 1 ? cyrillicText($text) : latinText($text);
}
//functions cyrillic to latin   and latin to cyrillic
if (!function_exists('latinText')) {
    function latinText($text)
    {
        return strtr($text, array(
            'А'=>'A', 'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E', 'Ё'=>'Yo', 'Ж'=>'J',
            'З'=>'Z', 'И'=>'I', 'Й'=>'Y', 'К'=>'K', 'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O',
            'П'=>'P', 'Қ' => 'Q', 'Р'=>'R', 'С'=>'S', 'Т'=>'T', 'У'=>'U', 'Ф'=>'F', 'Х'=>'X', 'Ц'=>'Ts',
            'Ч'=>'Ch', 'Ш'=>'Sh', 'Щ'=>'Sch', 'Ъ'=>'', 'Ы'=>'Y', 'Ь'=>'', 'Э'=>'E', 'Ю'=>'Yu',
            'Я'=>'Ya', 'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ё'=>'yo',
            'ж'=>'J', 'з'=>'z', 'и'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n',
            'о'=>'o', 'п'=>'p', 'қ' => 'q', 'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'х'=>'x',
            'ц'=>'ts', 'ч'=>'ch', 'ш'=>'sh', 'щ'=>'sch', 'ъ'=>'', 'ы'=>'y', 'ь'=>'', 'э'=>'e',
            'ю'=>'yu', 'я'=>'ya'
        ));
    }
}

if (!function_exists('convert_text_latin')) {
    function convert_text_latin($text)
    {
        $cyr = [
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
            'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р', 'С', 'Т', 'У', 'Ў', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
        ];
        $lat = [
            'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'j', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sh', 'a', 'i', 'y', 'e', 'yu', 'ya',
            'A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'J', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P',
            'R', 'S', 'T', 'U', 'O', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sh', 'A', 'I', 'Y', 'e', 'Yu', 'Ya'
        ];
        $textlat = mb_strtoupper(removeChars(str_replace($cyr, $lat, $text)));
        return $textlat;
    }
}

if (!function_exists('convert_text_latin2')) {
    function convert_text_latin2($text)
    {
        $cyr = [
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
            'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р', 'С', 'Т', 'У', 'Ў', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
        ];
        $lat = [
            'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'j', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sh', 'a', 'i', 'y', 'e', 'yu', 'ya',
            'A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'J', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P',
            'R', 'S', 'T', 'U', 'O', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sh', 'A', 'I', 'Y', 'e', 'Yu', 'Ya'
        ];
        $textlat = removeChars(str_replace($cyr, $lat, $text));
        return $textlat;
    }
}

if (!function_exists('removeChars')) {
    function removeChars($value)
    {
        $title = str_replace(array('\'', '"', ',', ';', '.', '’','-','‘','/'), ' ', $value);
        return $title;
    }
}

if (!function_exists('removeMarks')) {
    function removeMarks($value)
    {
        $title = str_replace(array('\'', '’','‘','`','?'), '', $value);
        return $title;
    }
}

if (!function_exists('phoneFormat')) {
    function phoneFormat($value)
    {
        if (strlen($value) == 9)
            return '+998'.$value;
        else
            return $value;
    }
}
if (!function_exists('message_set'))
{
    function message_set($message,$type,$timer = 15)
    {
        session()->put('_message',$message);
        session()->put('_type',$type);
        session()->put('_timer',$timer*1000);
    }
}

if (!function_exists('message_clear'))
{
    function message_clear()
    {
        session()->pull('_message');
        session()->pull('_type');
        session()->pull('_timer');
    }
}

if (!function_exists('sendByTelegram'))
{
    function sendByTelegram($message,$chatID,$token)
    {
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?parse_mode=HTML&chat_id=" . $chatID;
        $url = $url . "&text=" . urlencode($message);

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-type:application/json']);

        //ssl settings
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }
}

if (!function_exists('logObj'))
{
    function logObj($object)
    {
        $unset_list = [
            'updated_at',
            'created_at',
            'email_verified_at',
            'roles'
        ];

        foreach ($unset_list as $item) {
            unset($object->{$item});
            unset($object[$item]);
        }

        return json_encode($object);
    }
}

if( !function_exists('abort_if_forbidden') ){
    function abort_if_forbidden(string $permission,$message = "You have not permission to this page!"):void
    {
        abort_if(!auth()->user()->can($permission),403,$message);
    }
}

if( !function_exists('abort_if_api') ){
    function abort_if_api(string $permission,$message = "у вас нет доступа!"):void
    {
        abort_if(
            !auth()->user()->can($permission),
            response()->json([
                'jsonrpc'   => "2.0",
                'status'    => false,
                'origin'    => $permission,
                'error'     => ["message" => $message,"code" => 403 ],
                'host'      => [
                    "host" => "Trucks.uz",
                    "time_stamp"=>gmdate("Y-m-d H:i:s", time() + (5 * 60 * 60))
                ]
            ], 403)
        );
    }
}

if( !function_exists('uploadcare_service') ){
    function uploadcare_service($arr_img)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://upload.uploadcare.com/base/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $arr_img,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
}
if( !function_exists('getAddress') ) {
    function getAddress($location){
        $result = Http::get("https://geocode-maps.yandex.ru/1.x/",[
            'apikey'    =>  '822883d3-3053-47eb-a211-8118591f9d17',
            'format'    =>  'json',
            'geocode'   =>  $location,
        ])->json();
        if (isset($result['response'])){
            return $result['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['text'];
        }
        return false;
    }
}
