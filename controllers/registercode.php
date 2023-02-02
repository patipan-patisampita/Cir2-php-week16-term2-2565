<?php include_once('../config/dbcon.php'); ?>

<?php
if (isset($_POST['register_btn'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $role_as = mysqli_real_escape_string($con, $_POST['role_as']);

    $photo = $_FILES['photo']['name'];
    $photo_extension = pathinfo($photo, PATHINFO_EXTENSION); //rename thois photo
    $filename = time() . '.' . $photo_extension;

    $active = $_POST['active'] == true ? 1 : '0';
    if($password == $confirm_password){
        //Check Email
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $check_email_run = mysqli_query($con,$check_email);
        if(mysqli_num_rows($check_email_run)>0){
            //มีอีเมลล์ใช้แล้ว
            $_SESSION['message'] = 'อีเมลล์นี้ถูกใช้แล้ว';
            print("อีเมลล์นี้ถูกใช้แล้ว");
            header('Location: ../register.php');
            exit(0);
        }else{
            $query = "";
        }
    }
    else{
        $_SESSION['message'] = 'รหัสผ่านไม่ตรงกัน';
        print("รหัสผ่านไม่ตรงกัน");
        header('Location: ../register.php');
        exit(0);
    }

} else {
    $_SESSION['message'] = 'ข้อมูลส่งมามีปัญหา';
    print('ข้อมูลส่งมามีปัญหา');
    header('Location: ../register.php');
    exit(0);
}
?>
