<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Functions{

    protected $CI;

    function __construct(){
        $this->CI =& get_instance();
    }

    function check_session(){
        if(!isset($this->CI->session->logged_in)){
            redirect('auth');
        }
    }

    function convert_date_indo($array){
        $datetime=$array['datetime'];
        $y=substr($datetime,0,4);
        $m=substr($datetime,5,2);
        $d=substr($datetime,8,2);
        $conv_datetime=date("j/m/Y",mktime(1,0,0,$m,$d,$y));#"$d / $m / $y";
        return($conv_datetime);
    }

    function convert_date_indo2($array)
    {
        $datetime=$array['datetime'];
        $y=substr($datetime,0,4);
        $m=substr($datetime,5,2);
        $d=substr($datetime,8,2);
        $conv_datetime=date("j-m-Y",mktime(1,0,0,$m,$d,$y));#"$d - $m - $y";
        return($conv_datetime);
    }

    /* ------------------------------
    // Konversi tanggal tgl indo ke sql
    //
    // Usage :  convert_date_sql("31/12/2014") return 2014-12-31
    -------------------------------*/
    function convert_date_sql($date){
        list($day, $month, $year) = preg_split('/[\/\.\-]/', $date);
        return "$year-".sprintf("%02d", $month)."-".sprintf("%02d", $day);
    }

    function check_bulan($tanggal){
        $bulan_array=array(
            "1"=>"Januari",
            "2"=>"Februari",
            "3"=>"Maret",
            "4"=>"April",
            "5"=>"Mei",
            "6"=>"Juni",
            "7"=>"Juli",
            "8"=>"Agustus",
            "9"=>"September",
            "10"=>"Oktober",
            "11"=>"November",
            "12"=>"Desember");
        $tanggal_array=preg_split('/[\/\.\-]/', $tanggal);
        $bulan_n=date("n",mktime("1","1","1",$tanggal_array[1],$tanggal_array[2],$tanggal_array[0]));
        return $bulan_array[$bulan_n];
    }

    function format_tgl_cetak($tanggal) {
        list($year, $month, $day) = preg_split('/[\/\.\-]/', $tanggal);
        return intval($day)." ".$this->check_bulan($tanggal)." ".$year;
    }

}
