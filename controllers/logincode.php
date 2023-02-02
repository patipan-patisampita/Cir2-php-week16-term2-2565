<?php session_start(); ?>
<?php include_once('../config/dbcon.php'); ?>

<?php
if(isset($_POST['login_btn'])){
   $email =  mysqli_real_escape_string($con,$_POST['email']);
   $password =  mysqli_real_escape_string($con,$_POST['password']);

  $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
  $login_query_run = mysqli_query($con,$login_query); //ถ้ามี email และ email ในตาราง users จะตอบ true หรือ 1

  if(mysqli_num_rows($login_query_run)>0){
    foreach($login_query_run as $data ){
        $user_id = $data['id'];
        $user_name = $data['name'];
        $user_email = $data['email'];
        $role_as = $data['role_as'];
        $active = $data['active'];
    }
    
    $_SESSION['auth'] = true;
    $_SESSION['auth_role'] = "$role_as";
    $_SESSION['auth_active'] = "$active";
    $_SESSION['auth_user']=[
        'user_id' => $user_id,
        'user_name' => $user_name,
        'user_email' => $user_email,
    ];

    if($_SESSION['auth_role'] == '1' && $_SESSION['auth_active'] == '1'){ //1.ผู้ดูแลร้านอาหาร
        $_SESSION['message'] = 'ยินดีต้อนรับเข้าสู่ แดชบอร์ก ผู้จัดการร้านอาหาร';
        header('Location: ../manager/index.php');
        exit(0);
    }
    elseif($_SESSION['auth_role'] == '2' && $_SESSION['auth_active'] == '1'){ //2.สมาชิกหรือลูกค้า
        $_SESSION['message'] = 'ยินดีต้อนรับเข้าสู่ แดชบอร์ก สมาชิกหรือลูกค้า';
        header('Location: ../customer/index.php');
        exit(0);
    }
    elseif($_SESSION['auth_role'] == '3' && $_SESSION['auth_active'] == '1'){ //3.ผู้ส่งอาหาร
        $_SESSION['message'] = 'ยินดีต้อนรับเข้าสู่ แดชบอร์ก ผู้ส่งอาหาร';
        header('Location: ../index.php');
        exit(0);
    }

    elseif($_SESSION['auth_role'] == '4' && $_SESSION['auth_active'] == '1'){ //4.ผู้ดูแลระบบ
        $_SESSION['message'] = 'ยินดีต้อนรับเข้าสู่ แดชบอร์ก ผู้ดูแลระบบ';
        header('Location: ../admin/index.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = 'กรุณารอการอนุมัติการเป็นสมาชิก';
        header('Location: ../login.php');
        exit(0);
    }


  }else{
    $_SESSION['message'] = 'อีเมลล์หรือรหัสผ่านไม่ถูกต้อง';
    header('Location: ../login.php');
    exit(0);
  }
    

}else{
    $_SESSION['message'] = 'ยังไม่สามารถเข้าสู่ระบบได้';
    header('Location: ../login.php');
    exit(0);
}

?>