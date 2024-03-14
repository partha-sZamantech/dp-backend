<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class BanglaDateController extends Controller
{
    private $timestamp; //timestamp as input
    private $morning; //when the date will change?
    private $engHour; //Current hour of English Date
    private $engDate; //Current date of English Date
    private $engMonth; //Current month of English Date
    private $engYear; //Current year of English Date
    private $bangDate; //generated Bangla Date
    private $bangMonth; //generated Bangla Month
    private $bangYear; //generated Bangla   Year

    private $bn_months = array("পৌষ", "মাঘ", "ফাল্গুন", "চৈত্র", "বৈশাখ", "জ্যৈষ্ঠ", "আষাঢ়", "শ্রাবণ", "ভাদ্র", "আশ্বিন", "কার্তিক", "অগ্রহায়ণ");
    //private $bn_month_dates = array(30,30,30,30,31,31,31,31,31,30,30,30);
    //private $bn_month_middate = array(13,12,14,13,14,14,15,15,15,15,14,14);
    private $bn_month_dates = array(30,30,29,30,31,31,31,31,31,31,30,30);
    private $bn_month_middate = array(14,13,14,13,14,14,15,15,15,15,14,14);
    private $lipyearindex = 3;

    /*
     * Set the initial date and time
     *
     * @param   int timestamp for any date
     * @param   int, set the time when you want to change the date. if 0, then date will change instantly.
     *          If it's 6, date will change at 6'0 clock at the morning. Default is 6'0 clock at the morning
     */

     public function __construct( $timestamp, $hour = 6 ) {
         $this->BanglaDate( $timestamp, $hour );
     }

    /*
     * PHP4 Legacy constructor
     */

    /**
     * @param int $timestamp
     * @param type $hour
     */
    public function BanglaDate( $timestamp, $hour = 6 ) {
        $this->engDate = date( 'd', $timestamp );
        $this->engMonth = date( 'm', $timestamp );
        $this->engYear = date( 'Y', $timestamp );
        $this->morning = $hour;
        $this->engHour = date( 'G', $timestamp );

        //calculate the bangla date
        $this->calculate_date();

        //now call calculate_year for setting the bangla year
        $this->calculate_year();

        //convert english numbers to Bangla
        $this->convert();
    }

    public function set_time( $timestamp, $hour = 6 ) {
        $this->BanglaDate( $timestamp, $hour );
    }

    /**
     * Calculate the Bangla date and month
     *
     * @access private
     */
    private function calculate_date() {
        $this->bangDate = $this->engDate - $this->bn_month_middate[$this->engMonth - 1];
        if ($this->engHour < $this->morning)
            $this->bangDate -= 1;

        if (($this->engDate <= $this->bn_month_middate[$this->engMonth - 1]) || ($this->engDate == $this->bn_month_middate[$this->engMonth - 1] + 1 && $this->engHour < $this->morning) ) {
            $this->bangDate += $this->bn_month_dates[$this->engMonth - 1];
            if ($this->is_leapyear() && $this->lipyearindex == $this->engMonth)
                $this->bangDate += 1;
            $this->bangMonth = $this->bn_months[$this->engMonth - 1];
        }
        else{
            $this->bangMonth = $this->bn_months[($this->engMonth)%12];
        }
    }

    /*
     * Checks, if the date is leapyear or not
     *
     * @return boolen. True if it's leap year or returns false
     */

    public function is_leapyear() {
        if ( $this->engYear % 400 == 0 || ($this->engYear % 100 != 0 && $this->engYear % 4 == 0) )
            return true;
        else
            return false;
    }

    /*
     * Calculate the Bangla Year
     */

    public function calculate_year() {
        $this->bangYear = $this->engYear - 593;
        if (($this->engMonth < 4) || (($this->engMonth == 4) && (($this->engDate < 14) || ($this->engDate == 14 && $this->engHour < $this->morning))))
            $this->bangYear -= 1;
    }

    /*
     * Convert the English character to Bangla
     *
     * @param int any integer number
     * @return string as converted number to bangla
     */

    public function bangla_number( $int ) {
        $engNumber = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
        $bangNumber = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');

        $converted = str_replace( $engNumber, $bangNumber, $int );
        return $converted;
    }

    /*
     * Calls the converter to convert numbers to equivalent Bangla number
     */

    public function convert() {
        $this->bangDate = $this->bangla_number( $this->bangDate );
        $this->bangYear = $this->bangla_number( $this->bangYear );
    }

    /*
     * Returns the calculated Bangla Date
     *
     * @return array of converted Bangla Date
     */

    public function get_date() {
        return array($this->bangDate, $this->bangMonth, $this->bangYear);
    }

    /*
     * Input time Time
     * Returns the calculated Bangla time
     *
     * @return array of converted Bangla time
     */


    public function fFormatDate($BDDate){
        $en=array("AM","PM","am","pm","Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","January","February","March","April","May","June","July","August","September","October","November","December","0","1","2","3","4","5","6","7","8","9");
        $bn=array("পূর্বাহ্ণ","অপরাহ্ণ","পূর্বাহ্ণ","অপরাহ্ণ","শনিবার","রোববার","সোমবার","মঙ্গলবার","বুধবার","বৃহস্পতিবার","শুক্রবার","জানুয়ারি","ফেব্রুয়ারি","মার্চ","এপ্রিল","মে","জুন","জুলাই","আগস্ট","সেপ্টেম্বর","অক্টোবর","নভেম্বর","ডিসেম্বর","০","১","২","৩","৪","৫","৬","৭","৮","৯");
        $BDDate=str_replace($en,$bn,$BDDate);
        return $BDDate;
    }
}
