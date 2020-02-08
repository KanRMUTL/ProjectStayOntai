<?php
date_default_timezone_set("Asia/Bangkok");

function connect()
{
	$db_config = array(
		"host" => "localhost",  // กำหนด host
		"user" => "root", // กำหนดชื่อ user
		"pass" => "",   // กำหนดรหัสผ่าน
		"dbname" => "cistrain_tt43",  // กำหนดชื่อฐานข้อมูล
		"charset" => "utf8"  // กำหนด charset
	);


	$mysqli = @new mysqli($db_config["host"], $db_config["user"], $db_config["pass"], $db_config["dbname"]);
	if (mysqli_connect_error()) {
		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
		exit;
	}

	if (!$mysqli->set_charset($db_config["charset"])) { // เปลี่ยน charset เป้น utf8 พร้อมตรวจสอบการเปลี่ยน
		printf("Error loading character set utf8: %sn", $mysqli->error);  // ถ้าเปลี่ยนไม่ได้
	}

	return $mysqli;
}


function query($sql)
{
	$db = connect();

	if($db->query($sql)) { return true; }
	else { die("SQL Error: <br>".$sql."<br>".$db->error); return false; }
}



function result_array($sql)
{
	$data = array();
	$db = connect();

	$result = $db->query($sql) or die($db->error);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$data[] = $row;
	}

	return $data;
}

function row_array($sql)
{
	$data = array();
	$db = connect();

	$result = $db->query($sql) or die($db->error);
	$data = $result->fetch_array(MYSQLI_ASSOC);

	return $data;
}

//    ฟังก์ชันสำหรับการ insert ข้อมูล
function insert($table, $data)
{
	$db = connect();

	$fields = "";
	$values = "";
	$i = 1;
	foreach ($data as $key => $val) {
		if ($i != 1) {
			$fields .= ", ";
			$values .= ", ";
		}
		$fields .= "$key";
		$values .= "'$val'";
		$i++;
	}
	$sql = "INSERT INTO $table ($fields) VALUES ($values)";
	if ($db->query($sql)) {
		return true;
	} else {
		die("SQL Error: <br>" . $sql . "<br>" . $db->error);
		return false;
	}
}

//    ฟังก์ชันสำหรับการ update ข้อมูล
function update($table, $data, $where)
{
	$db = connect();

	$modifs = "";
	$i = 1;
	foreach ($data as $key => $val) {
		if ($i != 1) {
			$modifs .= ", ";
		}
		$modifs .= $key . " = '" . $val . "'";
		$i++;
	}
	$sql = ("UPDATE $table SET $modifs WHERE $where");
	if ($db->query($sql)) {
		return true;
	} else {
		die("SQL Error: <br>" . $sql . "<br>" . $db->error);
		return false;
	}
}


function delete($table, $where)
{
	$db = connect();

	$sql = "DELETE FROM $table WHERE $where";
	if ($db->query($sql)) {
		return true;
	} else {
		die("SQL Error: <br>" . $sql . "<br>" . $db->error);
		return false;
	}
}



?>
