<?php
session_start();
include_once "config.php";
if (isset($_POST['loginform'])) {
  $username = $link->real_escape_string($_POST['form_username']);
  $password = $link->real_escape_string($_POST['form_password']);
  $checkencrypt = md5($password);
  $login_query = "SELECT * FROM bfp_users WHERE username = '$username' AND password = '$checkencrypt' LIMIT 1";
  $read_query = $link->query($login_query);

  if ($read_query->num_rows > 0) {
    $check_position = $read_query->fetch_assoc();
    if ($check_position['status'] == 'false') {
      $res = [
        'status' => 500,
        'message' => 'This Account is not yet Verified'
      ];
      echo json_encode($res);
      return;
    } else {
      $_SESSION['login'] = true;
      $_SESSION['uid'] = $check_position['uid'];
      $_SESSION['position'] = $check_position['position'];
      $link->query("UPDATE bfp_users SET active = 'Online', date_created=date_created 
      WHERE users_id = '".$check_position['users_id']."'");
      $res = [
        'status' => 200,
        'message' => 'Login Successfully'
      ];
      echo json_encode($res);
      return;
    }
  } else {

    $res = [
      'status' => 500,
      'message' => 'Username Or Password Is Incorrect'
    ];
    echo json_encode($res);
    return;
  }
} elseif (isset($_POST['registerform'])) {
  $types = ["image/jpeg", "image/jpg", "image/png"];
  $username = $link->real_escape_string($_POST['accountcode']);
  $email = $link->real_escape_string($_POST['emailadd']);
  $password = $link->real_escape_string($_POST['password']);
  $cpassword = $link->real_escape_string($_POST['cpassword']);
  $location = $link->real_escape_string($_POST['location']);
  $office = $link->real_escape_string($_POST['position']);
  $rand = rand();
  // 1
  $profile_name = $_FILES['profile-img']['name'];
  $profile_type = $_FILES['profile-img']['type'];
  $profile_tmp = $_FILES['profile-img']['tmp_name'];
  $new_name = $rand . ' ' . $profile_name;
  $folder1 = "../assets/img/" . $new_name;


  $batangas = array(
    'Agoncillo', 'Alitagtag', 'Balayan', 'Balete', 'Batangas City', 'Bauan',
    'Calaca', 'Calatagan', 'Cuenca', 'Ibaan', 'Laurel', 'Lemery',
    'Lian', 'Lipa', 'Lobo', 'Mabini', 'Malvar', 'Mataas na kahoy',
    'Nasugbu', 'Padre Garcia', 'Rosario', 'San Jose', 'San Juan', 'San Luis',
    'San Nicolas', 'San Pascual', 'Santa Teresita', 'Santo Tomas', 'Taal',
    'Talisay', 'Tanauan', 'Taysan', 'Tingloy', 'Tuy'
  );
  $cavite = array(
    'Alfonso', 'Amadeo', 'Bacoor', 'Carmona', 'Cavite City', 'Dasmariñas',
    'General Emilio Aguinaldo', 'General Mariano Alvarez', 'General Trias', 'Imus', 'Indang', 'Kawit',
    'Magallanes', 'Maragondon', 'Mendez', 'Naic', 'Noveleta', 'Rosario',
    'Silang', 'Tagaytay', 'Tanza', 'Ternate', 'Trece Martires'
  );
  $laguna = array(
    'Alaminos', 'Bay', 'Biñan', 'Cabuyao', 'Calamba', 'Calauan',
    'Cavinti', 'Famy', 'Kalayaan', 'Liliw', 'Los Baños', 'Luisiana',
    'Lumban', 'Mabitac', 'Magdalena', 'Majayjay', 'Nagcarlan', 'Paete',
    'Pagsanjan', 'Pakil', 'Pangil', 'Pila', 'Rizal', 'San Pablo', 'San Pedro',
    'Santa Cruz', 'Santa Maria', 'Santa Rosa', 'Siniloan', 'Victoria'
  );
  $quezon = array(
    'Agdangan', 'Alabat', 'Atimonan', 'Buenavista', 'Burdeos', 'Calauag',
    'Candelaria', 'Catanauan', 'Dolores', 'General Luna', 'General Nakar', 'Guinayangan',
    'Gumaca', 'Infanta', 'Jomalig', 'Lopez', 'Lucban', 'Lucena',
    'Macalelon', 'Mauban', 'Mulanay', 'Padre Burgos', 'Pagbilao', 'Panukulan',
    'Patnanungan', 'Perez', 'Pitogo', 'Plaridel', 'Polillo', 'Quezon',
    'Real', 'Sampaloc', 'San Andres', 'San Antonio', 'San Francisco', 'San Narciso',
    'Sariaya', 'Tagkawayan', 'Tayabas', 'Tiaong', 'Unisan'
  );
  $rizal = array(
    'Angono', 'Antipolo', 'Baras', 'Binangonan', 'Cainta', 'Cardona',
    'Jalajala', 'Morong', 'Pililla', 'Rodriguez', 'San Mateo', 'Tanay',
    'Taytay', 'Teresa'
  );

  if (in_array($location, $batangas)) {
    $municipal = "Batangas";
  } elseif (in_array($location, $cavite)) {
    $municipal = "Cavite";
  } elseif (in_array($location, $laguna)) {
    $municipal = "Laguna";
  } elseif (in_array($location, $quezon)) {
    $municipal = "Quezon";
  } elseif (in_array($location, $rizal)) {
    $municipal = "Rizal";
  } elseif ($location == 'Batangas') {
    $municipal = "Batangas";
  } elseif ($location == 'Cavite') {
    $municipal = "Cavite";
  } elseif ($location == 'Laguna') {
    $municipal = "Laguna";
  } elseif ($location == 'Quezon') {
    $municipal = "Quezon";
  } elseif ($location == 'Rizal') {
    $municipal = "Rizal";
  }
  $uid = uniqid();
  if ($location == "" || $office == "") {
    $res = [
      'status' => 500,
      'message' => 'Error'
    ];
    echo json_encode($res);
    return;
  } else {
    $checkencrypt = md5($password);
    if ($cpassword == $password) {
      $a = $link->query("SELECT uid FROM bfp_users WHERE position = 'Admin'");
      $sh_a = $a->fetch_assoc();
      $query = "INSERT INTO bfp_users (uid, email, profile_img, username, password, location, status, position, municipal, active) 
      VALUES ('$uid','$email','$new_name','$username','$checkencrypt','$location','false','$office','$municipal','offline')";
      if (in_array($profile_type, $types)) {
        if (move_uploaded_file($profile_tmp, $folder1)) {
          if ($link->query($query)) {
            $link->query("INSERT INTO `notification`(`uid`, `title`, `content`, `click`) 
            VALUES ('" . $sh_a['uid'] . "','New registration','There is a new registration','0')");
            $res = [
              'status' => 200,
              'message' => 'Registered Successfully'
            ];
            echo json_encode($res);
            return;
          } else {
            $res = [
              'status' => 500,
              'message' => 'Something Went Wrong'
            ];
            echo json_encode($res);
            return;
          }
        } else {
          $res = [
            'status' => 500,
            'message' => 'Something Went Wrong Unable to Upload The Profile Photo'
          ];
          echo json_encode($res);
          return;
        }
      } else {
        $res = [
          'status' => 500,
          'message' => 'Profile Image is not in (jpg, jpeg, png) Format'
        ];
        echo json_encode($res);
        return;
      }
    } else {
      $res = [
        'status' => 500,
        'message' => 'Password Is not match'
      ];
      echo json_encode($res);
      return;
    }
  }
}
