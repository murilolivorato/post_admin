<?php
/**
 * Created by PhpStorm.
 * UserPub: Murilo
 * Date: 12/30/2017
 * Time: 7:28 PM
 */

/* verify if the menu is  active */
function set_active($path , $segment = Null) {

    $active = 'class=active';
    $url_active = $segment == Null ?  Request::segment(2) : Request::segment($segment);

    return  in_array($url_active,$path) ? $active : '';
}

function set_activ_class($path , $pg ) {

    return  in_array($pg,$path) ? 'active' : '';
}

function set_cat_active($path , $pg_cat){

    $active = 'class=active';
    return  $path == $pg_cat ? $active : '';
}


/* verify if the menu is  active */
function set_url_active($path, $active = 'class=active') {

    // get the element
    $url_admin = Request::segment(1);
    return  in_array($url_admin,$path) ? $active : '';


}


/**********************************************************************************
ADD ARRAY ELEMENT
 ***********************************************************************************/
function addArrayElement($items){
    $value = [];
    // if has - , so gives it a foreach
    if( strpos( $items, '-' ) !== false ) {
        foreach (explode("-",$items) as $item):
            array_push($value , $item);
        endforeach;
    }else{
        array_push($value , $items);
    }

    // if is empty return empty
    if (empty(array_filter($value))) {
        return;
    }

    return $value;
}

function moneyFormat($int){

    return number_format(substr($int,0,(strlen($int)-2)).".".substr($int,strlen($int)-2,2),2,',','.');
}

function url_title($str){
    $str = strtolower(utf8_decode($str)); $i=1;
    $str = strtr($str, utf8_decode('àáâãäåæçèéêëìíîïñòóôõöøùúûýýÿ'), 'aaaaaaaceeeeiiiinoooooouuuyyy');
    $str = preg_replace("/([^a-z0-9])/",'-',utf8_encode($str));
    while($i>0) $str = str_replace('--','-',$str,$i);
    if (substr($str, -1) == '-') $str = substr($str, 0, -1);
    return $str;
}


function url_folder ($string){

    return  randon_number()."_".strtolower(str_replace("-","_" ,url_title($string)));
}


function randon_number(){
    return  substr(number_format(time() * rand(),0,'',''),0,7);
}


function makeThumbName($file) {

    $image_thumb    = explode(".", $file  );

    return $image_thumb[0]."_thumb.".$image_thumb[1];
}



function link_action_btn( $type = null  , $path = NULL  )
{

    $displayLinkAction = app('App\Http\LinkAction');

    if(func_num_args() == 0 ){
        return $displayLinkAction;
    }

    return $displayLinkAction->edit($type ,$path);

}


function verifyDateTime($date , $verify_date){

    $dateFromDatabase = strtotime($date);
    $dateTwelveHoursAgo = strtotime("-".$verify_date);

    return $dateFromDatabase >= $dateTwelveHoursAgo ? true : false ;


}

function removedatespaces($date){

    $string = str_replace ("-", "", $date);
    $string = str_replace (" ", "", $string);
    $string = str_replace (":", "", $string);

    return $string;
}

/* ----------------------------------------DATES */
function convertDataPostFormat($date){
    $date =  date('d/m/Y', strtotime($date));
    $date  = explode("/", $date);

    $day  =  $date[0];
    $month =  makeMonthDate($date[1]);

    return $day."@".$month;

}

function makeMonthDate($dateString){

    switch ($dateString) {
        case 1:
            $value = "JAN";
        case 2:
            $value = "FEV";;
        case 3:
            $value = "MAR";
        case 4:
            $value = "ABR";
        case 5:
            $value = "MAI";
        case 6:
            $value = "JUN";
        case 7:
            $value = "JUL";
        case 8:
            $value = "AGO";
        case 9:
            $value = "SET";
        case 10:
            $value = "OUT";
        case 11:
            $value = "NOV";
        case 12:
            $value = "DEZ";

    }

    return $value;
}

/* convert date format */
function convertDatetoBr($date){
    return date('d/m/Y', strtotime($date));
}

function convertDatetoBr2($date){
    return date('d/m/Y H:i:s', strtotime($date));
}

function convertDatetoBr3($date){
    return date('dmY', strtotime($date));
}

function convertDateBr3($date) {

    $curr_date=strtotime(date("Y-m-d H:i:s"));
    $the_date=strtotime($date);
    $diff=floor(($curr_date-$the_date)/(60*60*24));
    switch($diff)
    {
        case 0:
            return "Hoje";
            break;
        case 1:
            return "Ontem";
            break;

        default:
            return  $diff >=  6 ? convertDatetoBr($date) : $diff." Dias Atrás";
    }

}

function convertDatetoEn($date){

    $date = date("Y-m-d",strtotime(str_replace('/','-',$date)));
    return  date('Y-m-d', strtotime($date));

}

// RSS TAG URL
function makeTimeDbFormat($date){

    $dateStr = explode("/",$date);

    $output[] = $dateStr[2];
    $output[] = $dateStr[1];
    $output[] = $dateStr[0];

    return implode('', $output);
}


function limit_text($text, $max_characters) {

    if(strlen($text) > $max_characters ){
        $text = substr($text ,0, $max_characters )."  ...";
    }else {
        $text = $text;
    }
    return  $text;
}


function folder_path_str($folderStr)
{
    return substr($folderStr , 1  );
}

/* date formate */
function get_date_format($format , $date){
    if($format == 1){
        $getdate = date( 'd/m/Y -  H:i:s', strtotime($date));
    }else if ($format == 2){
        $getdate = date( 'd/m/Y', strtotime($date));
    }

    return $getdate;
}


function testtxt($value){
   $fp = fopen('./assets/txt/test_file.txt', 'w');
    fwrite($fp, $value);
    fclose($fp);
}

function printtxt($value){
   file_put_contents('./assets/txt/test_array.txt', print_r($value, true));
}



// make a collection and verify if exist the array
function verifyCollect ($collectItem , $item){

    return collect($collectItem)->intersect($item);
}

// make a collection and verify if exist the array
function verifyCollectMany ($collectItem , $items){


    foreach ($items as $item) {

        $colect_item =  verifyCollect($collectItem , (int) $item );

        $itemsColected = $colect_item->count() ? true : abort(403, 'página não existe');

    }

    return $itemsColected;

}

// removeElement from array
function removeElementArray($array,$value) {
    if (($key = array_search($value, $array)) !== false) {
        unset($array[$key]);
    }
    return $array;
}



/* calculating distance */
function distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }


}


/**********************************************************************************
ADD ARRAY ELEMENT
 **********************************************************************************
protected function addArrayElement($items){
    $value = [];
    // if has - , so gives it a foreach
    if( strpos( $items, '-' ) !== false ) {
        foreach (explode("-",$items) as $item):
            array_push($value , $item);
        endforeach;
    }else{
        array_push($value , $items);
    }

    // if is empty return empty
    if (empty(array_filter($value))) {
        return;
    }

    return $value;
}


 */
