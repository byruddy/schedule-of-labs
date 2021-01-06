<?php 

	// REQUEST FILE CONNECTION
	require_once('connection.php');

    // SET DEFAULT TIME
    date_default_timezone_set("Asia/Jakarta");

    // BASE URL
    define("BASE_URL", "http://localhost/jadwalPratikum/");

    // NAME APPLICATION
    define("np", "System Schedule Pratice");

    // ALL FUNCTION

    	// Checking for urlActive
    	function urlActive($value) {
    		$urlActive = $_SERVER['REQUEST_URI'];
    		$check 	   = $value;

    		if (strpos($urlActive, $check)) {
    			$isValid = true;
    		} else {
    			$isValid = false;
    		}
    		return $isValid;
    	}

    	// Query Read table from db
    	function queryRead($table) {
    		global $link;

    		$table 		= $table;
    		$runQuery 	= mysqli_query($link, "SELECT * FROM $table");

    		return $runQuery;
    	}


    	// Query only for choose majors
    	function chooseMajor($fakultasId) {
    		global $link;
    		$runQuery = mysqli_query($link, "SELECT id,nama FROM jurusan WHERE fakultasId='$fakultasId'");
    		return $runQuery;
    	}

 
    	// Convert date to format indonesia 
    	function hariIni(){
    		$hariIndonesia = array('Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu');

    		$hari = date('w');

    		$hariIndonesia = $hariIndonesia[$hari];

    		return $hariIndonesia;
    	}
    	function bulanIni(){
    		$bulanIndonesia = array('Januari','Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

    		$bulan = date('n') - 1;

    		$bulanIndonesia = $bulanIndonesia[$bulan];

    		return $bulanIndonesia;
    	}


    	// Checking for access file, only for user
    	function userAccess($only) {
            // No sign-in
    		if (!isset($_SESSION['user'])) {
    			$_SESSION['ilegal-access'] = "Sorry, you must login to access";
    			header('Location: '.BASE_URL.'user/login/');
    		} 
            // Ilegal Access ..
            $user = $_SESSION['user'];
            // Get level user
            global $link;
            $getLevel = mysqli_fetch_assoc(mysqli_query($link, "SELECT level FROM pengguna WHERE nim='$user'"));
            $getLevel = $getLevel['level'];

                // Checking
                if ($only == 'admin' && $getLevel == 'staff') {
                    header('Location: '.BASE_URL.'user');
                } elseif ($only == 'staff' && $getLevel == 'administrator') {
                    header('Location: '.BASE_URL.'user');
                }

    	}

        // Get level user sign-in
        function getLevel($idPengguna){
            global $link;
            $runQuery = mysqli_query($link, "SELECT level FROM pengguna WHERE nim=$idPengguna");
            $level = mysqli_fetch_assoc($runQuery);
            $level = $level['level'];

            return $level;
        }

    	// Get name room for ID
    	function nameRoom($id) {
    		global $link;

    		$query = "SELECT nama, namaLainnya FROM ruangan WHERE id='$id'";
    		$runQuery = mysqli_query($link, $query);
    		$name = mysqli_fetch_assoc($runQuery);

    		return $name['nama'].' - '.$name['namaLainnya'];

    	}

    	// Get name major for ID
    	function nameMajor($id) {
    		global $link;

    		$query = "SELECT nama FROM jurusan WHERE id='$id'";
    		$runQuery = mysqli_query($link, $query);
    		$name = mysqli_fetch_assoc($runQuery);

    		return $name['nama'];

    	}

        // Count data in table
        function countData($table) {
            global $link;
            $table = $table;
            $runQuery = mysqli_query($link, "SELECT * FROM $table");
            $countData = mysqli_num_rows($runQuery);

            return $countData;
        }


    	// Activitty
    	function activity($me){
    		global $link;

    		$read = mysqli_query($link, "SELECT * FROM aktivitas WHERE penggunaNim='$me'");
    		$aktivitas = mysqli_fetch_assoc($read);

    		return $aktivitas;
    	}


        // Get schedule only by room
        function getSchedule($roomId) {
            global $link;
            $query = "SELECT jadwalPratikum.ruanganId, jadwalPratikum.tglJadwal, jadwalPratikum.kelas, jadwalPratikum.mataKuliah, jadwalPratikum.namaDosen, jurusan.nama, jadwalPratikum.status, jadwalPratikum.penggunaNim FROM `jadwalPratikum` INNER JOIN jurusan ON jadwalPratikum.jurusanId = jurusan.id WHERE jadwalPratikum.ruanganId = $roomId ORDER BY tglJadwal DESC LIMIT 1";
            $runQuery = mysqli_query($link, $query);

            return $runQuery;
        }

        // Get name only in schedule 
        function nameOnly($nim) {
            global $link;
            $nama = mysqli_query($link, "SELECT nama FROM pengguna WHERE nim = $nim");
            $nama = mysqli_fetch_assoc($nama);
            $nama = $nama['nama'];

            return $nama;
        }

        // Nim for dashboard
        function nimDashboard($nim) {
            $start  = substr($nim, 0,3);
            $center = substr($nim, 3,3);
            $end    = substr($nim, 4,3);

            $nim = $start.'-'.$center.'-'.$end;

            return $nim;
        }





















