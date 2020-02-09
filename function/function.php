<?php
check_booking_date();

function check_booking_date()
{
    $time = timecancel() * -1;
    $now = date("Y-m-d H:i:s");
    $sql = "SELECT * , DATE_SUB(booking_date, INTERVAL {$time} HOUR) as check_date FROM tb_booking WHERE booking_status = 1";
    $result = result_array($sql);

    foreach ($result as $row) {
        if ($row['check_date'] < $now) {

            $arr = array(
                "booking_status" => 6
            );

            update("tb_booking", $arr, "booking_id = '{$row['booking_id']}'");

            $arr = array(
                "booking_detail_status" => 6
            );

            update("tb_booking_detail", $arr, "booking_id = '{$row['booking_id']}'");
        }
    }
}

function sms($tel, $msg)
{
    $sms = new thsms();

    $sms->username = 'ontaihomestay';
    $sms->password = '7a22ea';

    $b = $sms->send('0000', $tel, $msg);

    return $b;
}


class thsms
{
    var $api_url = 'http://www.thsms.com/api/rest';
    var $username = null;
    var $password = null;

    public function getCredit()
    {
        $params['method'] = 'credit';
        $params['username'] = $this->username;
        $params['password'] = $this->password;

        $result = $this->curl($params);

        $xml = @simplexml_load_string($result);

        if (!is_object($xml)) {
            return array(FALSE, 'Respond error');

        } else {

            if ($xml->credit->status == 'success') {
                return array(TRUE, $xml->credit->status);
            } else {
                return array(FALSE, $xml->credit->message);
            }
        }
    }

    public function send($from = '0000', $to = null, $message = null)
    {
        $params['method'] = 'send';
        $params['username'] = $this->username;
        $params['password'] = $this->password;

        $params['from'] = $from;
        $params['to'] = $to;
        $params['message'] = $message;

        if (is_null($params['to']) || is_null($params['message'])) {
            return FALSE;
        }

        $result = $this->curl($params);
        $xml = @simplexml_load_string($result);
        if (!is_object($xml)) {
            return array(FALSE, 'Respond error');
        } else {
            if ($xml->send->status == 'success') {
                return array(TRUE, $xml->send->uuid);
            } else {
                return array(FALSE, $xml->send->message);
            }
        }
    }

    private function curl($params = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        $lastError = curl_error($ch);
        $lastReq = curl_getinfo($ch);
        curl_close($ch);

        return $response;
    }
}

//session
session_start();

function set_session($key, $value)
{
    $_SESSION[$key] = $value;
}

function del_session($key)
{
    unset($_SESSION[$key]);
}

function check_session($key)
{
    return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
}


function destroy_session()
{
    session_destroy();
}


function check_login($SS, $url)
{
    if (check_session($SS)) {

    } else {
        header('Location:' . $url);
    }
}

function _print_r($arr)
{
    echo '<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />';
    echo '<pre>';
    print_r($arr);
    echo '<pre>';
    exit;
}

function date_th($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

function datetime_th($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute น.";
}

function mount_name($num)
{
    if ($num == 1) {
        $status = 'มกราคม';
    } elseif ($num == 2) {
        $status = 'กุมภาพันธ์';
    } elseif ($num == 3) {
        $status = 'มีนาคม';
    } elseif ($num == 4) {
        $status = 'เมษายน';
    } elseif ($num == 5) {
        $status = 'พฤษภาคม';
    } elseif ($num == 6) {
        $status = 'มิถุนายน';
    } elseif ($num == 7) {
        $status = 'กรกฎาคม';
    } elseif ($num == 8) {
        $status = 'สิงหาคม';
    } elseif ($num == 9) {
        $status = 'กันยายน';
    } elseif ($num == 10) {
        $status = 'ตุลาคม';
    } elseif ($num == 11) {
        $status = 'พฤศจิกายน';
    } elseif ($num == 12) {
        $status = 'ธันวาคม';
    }

    return $status;
}

function add_date($start, $day)
{
    $temp = str_replace('-', '/', $start);
    $date = date('Y-m-d', strtotime($temp . $day . " days"));

    return $date;
}


function role($num)
{
    $status = "ว่าง";

    if ($num == 3) {
        $status = "ผู้ดูแลระบบ";
    } elseif ($num == 2) {
        $status = "เลขานุการ";
    } elseif ($num == 1) {
        $status = "เจ้าของโฮมสเตย์";
    } elseif ($num == 0) {
        $status = "เอเจนซี่";
    } elseif ($num == 9) {
        $status = "ลูกค้า";
    }

    return $status;
}

function status($num)
{
    $status = "ว่าง";

    if ($num == 0) {
        $status = "ไม่ใช้งาน";
    } elseif ($num == 1) {
        $status = "ใช้งาน";
    }

    return $status;
}

function ledger_type($num)
{
    if ($num == 1) {
        $status = "รายรับ";
    } elseif ($num == 2) {
        $status = "รายจ่าย";
    }

    return $status;
}

function booking_id($id)
{
    return "B-" . sprintf("%06s", $id);
}

function booking_status($num)
{

    if ($num == 1) {
        $status = "รอชำระเงิน";
    } elseif ($num == 2) {
        $status = "รอเช็คยอดโอน";
    } elseif ($num == 3) {
        $status = "ชำระเงินแล้ว";
    } elseif ($num == 5) {
        $status = "เช็คเอาท์";
    } elseif ($num == 6) {
        $status = "ยกเลิก";
    }

    return $status;
}

function booking_detail_status($num)
{

    if ($num == 1) {
        $status = "รอชำระเงิน";
    } elseif ($num == 2) {
        $status = "รอเช็คยอดโอน";
    } elseif ($num == 3) {
        $status = "รอเช็คอิน";
    } elseif ($num == 4) {
        $status = "เช็คอิน";
    } elseif ($num == 5) {
        $status = "เช็คเอาท์";
    } elseif ($num == 6) {
        $status = "ยกเลิก";
    }

    return $status;
}

function booking_type($num)
{

    if ($num == 0) {
        $status = "ลูกค้า";
    } elseif ($num == 1) {
        $status = "เลขานุการ / เอเจนซี่ ";
    }

    return $status;
}

function check_user($user_id)
{
    $sql = "SELECT * FROM tb_user WHERE user_id = '{$user_id}' AND user_type = 9";
    $row = row_array($sql);

    return $row;
}

function cut_text($s, $max_length)
{
    if (strlen($s) > $max_length) {
        $offset = ($max_length - 3) - strlen($s);
        $s = substr($s, 0, strrpos($s, ' ', $offset)) . '...';
    }

    return $s;
}


function check_province($subdistrict_id)
{
    $sql = "SELECT * FROM tb_subdistricts a INNER  JOIN tb_districts b ON a.district_id = b.district_id INNER JOIN tb_provinces d ON b.province_id = d.province_id WHERE a.subdistrict_id = '{$subdistrict_id}'";
    $row = row_array($sql);

    return $row;
}

function check_secretary($user_id)
{
    $sql = "SELECT * FROM tb_user WHERE user_id = '{$user_id}' AND user_type = 2";
    $row = row_array($sql);

    return $row;
}

function check_owner($user_id)
{
    $sql = "SELECT * FROM tb_user WHERE user_id = '{$user_id}' AND user_type = 1";
    $row = row_array($sql);

    return $row;
}


function check_admin($user_id)
{
    $sql = "SELECT * FROM tb_user WHERE user_id = '{$user_id}' AND user_type = 3";
    $row = row_array($sql);

    return $row;
}

function check_agency($user_id)
{
    $sql = "SELECT * FROM tb_user WHERE user_id = '{$user_id}' AND user_type = 0";
    $row = row_array($sql);

    return $row;
}

function get_homestay($homestay_id)
{
    $sql = "SELECT * FROM tb_homestay WHERE homestay_id = '{$homestay_id}'";
    $row = row_array($sql);

    return $row['homestay_name'];
}

function check_booking_session($room_id)
{
    $status = 1;

    foreach ($_SESSION['homestay']['booking'] as $value) {
        if ($value == $room_id) {
            $status = 0;
            break;
        }
    }

    return $status;
}

function check_booking($room_id, $start, $end)
{

    $status = 1;

    $sql = "SELECT * FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id WHERE b.room_id = '{$room_id}' AND booking_detail_status < 5 AND (( '{$start}'  BETWEEN booking_check_in AND booking_check_out OR '{$end}' BETWEEN booking_check_in AND booking_check_out ) OR (booking_check_in BETWEEN '{$start}' AND '{$end}' OR booking_check_out BETWEEN '{$start}' AND '{$end}'))";
    $row = row_array($sql);

    if ($row) {

        if ($row['room_type'] == "ห้องส่วนตัว") {
            $status = 0;
        } elseif ($row['room_type'] == "ห้องรวม") {
            $check_booking_all = check_booking_all($room_id, $start, $end);

            if ($check_booking_all >= $row['room_beds']) {
                $status = 0;
            }
        }
    }


    return $status;

}

function check_booking_all($room_id, $start, $end)
{
    $sql = "SELECT COALESCE(SUM(booking_detail_adult + booking_detail_child),0) as num FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id WHERE b.room_id = '{$room_id}' AND booking_status < 6 AND (( '{$start}'  BETWEEN booking_check_in AND booking_check_out OR '{$end}' BETWEEN booking_check_in AND booking_check_out ) OR (booking_check_in BETWEEN '{$start}' AND '{$end}' OR booking_check_out BETWEEN '{$start}' AND '{$end}'))";
    $row = row_array($sql);
    $total = $row['num'];


    return $total;
}

function check_opiton_homestay($result)
{

    $data = array();
    $service_select = $_SESSION['homestay']['service'];

    if (count($service_select) > 0) {

        foreach ($result as $row) {
            foreach ($service_select as $service_id) {

                $status = 1;

                $sql = "SELECT * FROM tb_service_option WHERE service_id = '{$service_id}' AND homestay_id = '{$row['homestay_id']}'";
                $check_option = row_array($sql);

                if(!$check_option){
                    $status = 0;
                    break;
                }
            }

            if($status){
                $data[] = $row;
            }
        }

    } else {
        $data = $result;
    }


    return $data;

}

function set_beds($adult, $child, $room)
{
    $all = $adult + $child;

//    $num = 1;
//    if ($room > 1) {
//        $room = $room - 1;
//
//        $num = $all - $room;
//    } elseif ($room == 1) {
//        $num = $all;
//    }

    $num = FLOOR($all / $room);

    return $num;
}

function commission()
{
    $sql = "SELECT * FROM tb_system WHERE system_id = 1";
    $row = row_array($sql);

    $percen = $row['system_value'];
    return $percen;
}

function timecancel()
{
    $sql = "SELECT * FROM tb_system WHERE system_id = 2";
    $row = row_array($sql);

    $time = $row['system_value'];

    return $time;
}

function check_room_select($homestay_id){
    $status = 0;
    $count = count($_SESSION['homestay']['booking']);

    if($count > 0){
        foreach ($_SESSION['homestay']['booking'] as $room_id){
            $sql = "SELECT * FROM tb_room WHERE room_id = '{$room_id}'";
            $row = row_array($sql);

            if($row['homestay_id'] == $homestay_id){
                $status = 1;
                break;
            }
        }
    }

    return $status;
}


