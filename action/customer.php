<?php
session_start();
date_default_timezone_set('Europe/Sofia');

require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "115704@students.ue-varna.bg";
$mail->Password = "13071999E";

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

// Create profile
if (isset($_POST['save_customer'])) {

    $firstName = $_POST['firstName'];
    $familyName = $_POST['familyName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $passwordRep = $_POST['passwordRep'];
    $fullName = $firstName . " " . $familyName;
    $curDT = date('Y-m-d');

    if (!$firstName || !$familyName || !$email || !$phone || !$password || !$passwordRep) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        if (preg_match('/^[0-9+\(\)\s-]+$/', $phone)) {
            $selQuery = "SELECT 1 FROM customers WHERE email = '$email'";
            $query = mysqli_query($con, $selQuery);

            if (mysqli_num_rows($query) == 0) {

                if (preg_match('/^(?=.*[a-zа-яА-Я])(?=.*[A-ZА-Я])(?=.*\d)(?=.*[@$!%*?&])[A-Za-zа-яА-Я\d@$!%*?&]{8,}$/u', $password)) {
                    if ($password == $passwordRep) {
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $emailCode = rand(100000, 999999);

                        $mail->setFrom("carpetserv@gmail.com", "Carpet Services");
                        $mail->addAddress($email, $fullName);

                        $mail->Subject = "Carpet Services - Вашият код за потвърждение";
                        $mail->Body = "Вашият код е " . $emailCode;

                        $mail->send();

                        $query = "INSERT INTO customers (name,email,password,phone,created_at,email_code) VALUES ('$fullName','$email','$password','$phone','$curDT',$emailCode)";
                        $query_run = mysqli_query($con, $query);

                        jsonResponseMain($query_run, 'Успешна регистрация', 'Неуспешна регистрация');
                    } else {
                        jsonResponse(500, 'Въведените пароли не съвпадат');
                    }
                } else {
                    jsonResponse(500, 'Въведената парола трябва да съдържа поне една голяма, малка буква, цифра и специален знак');
                }
            } else {
                jsonResponse(500, 'Въведеният имейл вече съществува');
            }
        } else {
            jsonResponse(500, 'Телефонният номер може да съдържа само цифри, +, - и ()');
        }
    }
}

// Login
if (isset($_POST['login_info'])) {

    $email = ($_POST['email']);

    $query = "SELECT * FROM customers WHERE email='$email'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($rows = mysqli_fetch_array($query_run)) {

            if (password_verify($_POST['passowrdLogin'], $rows['password'])) {
                $_SESSION['email'] = $email;

                $res = [
                    'status' => 200,
                    'userEmail' => $email,
                ];
                echo json_encode($res);
                return;
            } else {
                jsonResponse(500, 'Грешена парола');
            }
        }
    } else {
        jsonResponse(500, 'Грешен имейл');
    }
}

// Update customer information
if (isset($_POST['update_customer'])) {

    $userEmail = $_POST['userEmail'];
    $username = $_POST['username'];
    $phone = $_POST['phoneAccount'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    if (!$username || !$phone) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "UPDATE customers SET username='$username', phone='$phone' WHERE email='$userEmail'";
        $query_run = mysqli_query($con, $query);

        jsonResponseMain($query_run, 'Данните са обновени', 'Данните не са обновени');
    }
}

// Upload photo
if (isset($_POST['update_customer_image'])) {

    $userEmail = $_POST['customerEmail'];
    $filename = $_FILES['customerImage']['name'];
    uploadPhoto($filename, "customerImage", '../uploaded-files/customer-images/');
    $filesize = $_FILES['customerImage']['size'];
    $filesize = number_format($filesize / 1048576, 2);

    if ($filesize < 2) {
        if (!$filename) {
            jsonResponse(500, 'Попълнете всички полета');
        } else {
            $query = "UPDATE customers SET image='$filename' WHERE email='$userEmail'";
            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Профилната снимката е обновена', 'Снимката не е обновена');
        }
    } else {
        jsonResponse(500, 'Снимката, която се опитвате да добавите е по-голяма от 2MB');
    }
}

// Update password
if (isset($_POST['update_customer_password'])) {

    $userEmail = $_POST['customerEmail'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $newPasswordRep = $_POST['newPasswordRep'];

    if (!$newPassword || !$newPasswordRep || !$oldPassword) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "SELECT * FROM customers WHERE email='$userEmail'";
        $query_run = mysqli_query($con, $query);

        while ($rows = mysqli_fetch_array($query_run)) {

            if (password_verify($_POST['oldPassword'], $rows['password'])) {
                if ($newPassword == $newPasswordRep) {
                    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

                    $queryy = "UPDATE customers SET password='$newPassword' WHERE email='$userEmail'";
                    $query_runn = mysqli_query($con, $queryy);

                    jsonResponseMain($query_runn, 'Паролата е обновена', 'Паролата не е обновена');
                } else {
                    jsonResponse(500, 'Паролите не съвпадат');
                }
            } else {
                jsonResponse(500, 'Старата паролата е грешна');
            }
        }
    }
}

// Log out
if (isset($_POST['action'])) {
    unset($_SESSION['email']);
    jsonResponse(200, 'Успешно излизане');
}

// Customer make order
if (isset($_POST['customer_order'])) {

    $customerName = $_POST['customerName'];
    $customerEmail = $_POST['customerEmail'];
    $customerPhone = $_POST['customerPhone'];
    $building = $_POST['building'];
    $offer = $_POST['offer'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $payment = $_POST['payment'];
    $invoice = $_POST['invoice'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $information = $_POST['information'];
    $price = $_POST['price'];
    $m2 = $_POST['m2'];
    $company = $_POST['company'];
    $eik = $_POST['eik'];
    $curDT = date('Y-m-d H:i:s');

    if (!$building || !$offer || !$time || !$payment || !$invoice || !$city || !$address || !$m2 || !$price) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        if (is_numeric($m2)) {
            if ($company && $eik) {
                $queryy = "UPDATE customers SET company_name='$company', company_eik = '$eik', address = '$address' WHERE email='$customerEmail'";
                $query_runn = mysqli_query($con, $queryy);

                $query = "INSERT INTO orders (customer_name,address,room,m2,status,pay,price,date,offer,add_date,phone,view,time,email,city,invoice,customer_kind,information,team_id,company_name,company_eik) VALUES ('$customerName','$address','$building','$m2','Назначи','$payment','$price','$date','$offer','$curDT','$customerPhone','1','$time','$customerEmail','$city','$invoice','Потребител','$information','0','$company','$eik')";
                $query_run = mysqli_query($con, $query);

                jsonResponseMain2($query_run, $query_runn, 'Успешно направена заявка', 'Неуспешно направена заявка');
            } else {
                $query = "INSERT INTO orders (customer_name,address,room,m2,status,pay,price,date,offer,add_date,phone,view,time,email,city,invoice,customer_kind,information,team_id) VALUES ('$customerName','$address','$building','$m2','Назначи','$payment','$price','$date','$offer','$curDT','$customerPhone','1','$time','$customerEmail','$city','$invoice','Потребител','$information','0')";
                $query_run = mysqli_query($con, $query);

                jsonResponseMain($query_run, 'Успешно направена заявка', 'Неуспешно направена заявка');
            }
        } else {
            jsonResponse(500, 'Полето квадратура приема само числа');
        }
    }
}

// Get customer data by id
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $con->prepare("SELECT * FROM orders WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $order = $result->fetch_assoc();

        $res = [
            'status' => 200,
            'data' => $order
        ];
        echo json_encode($res);
    } else {
        jsonResponse(404, 'Клиента не е намерен');
    }
    $stmt->close();
}

// Get customer data by email
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $stmt = $con->prepare("SELECT * FROM customers WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $order = $result->fetch_assoc();

        $res = [
            'status' => 200,
            'data' => $order
        ];
        echo json_encode($res);
    } else {
        jsonResponse(404, 'Клиента не е намерен');
    }
    $stmt->close();
}

// Upload customer room image
if (isset($_POST['customer_upload_room'])) {

    $customerEmail = $_POST['customerEmail'];
    $filename = $_FILES['roomImage']['name'];
    uploadPhoto($filename, "roomImage", '../uploaded-files/room-images/');
    $filesize = $_FILES['roomImage']['size'];
    $filesize = number_format($filesize / 1048576, 2);

    if ($filesize < 2) {
        if (!$filename) {

            jsonResponse(500, 'Добавете снимка');
        } else {
            $queryq = "SELECT * FROM customers WHERE email='$customerEmail'";
            $query_runq = mysqli_query($con, $queryq);

            while ($rows = mysqli_fetch_array($query_runq)) {
                if ($rows["image_room1"] == NULL) {
                    $queryy = "UPDATE customers SET image_room1='$filename' WHERE email='$customerEmail'";
                    $query_runn = mysqli_query($con, $queryy);
                    jsonResponseMain($query_runn, 'Снимакта е добавена', 'Снимката не е добавена');
                } else if ($rows["image_room2"] == NULL) {
                    $queryy = "UPDATE customers SET image_room2='$filename' WHERE email='$customerEmail'";
                    $query_runn = mysqli_query($con, $queryy);
                    jsonResponseMain($query_runn, 'Снимакта е добавена', 'Снимката не е добавена');
                } else if ($rows["image_room3"] == NULL) {
                    $queryy = "UPDATE customers SET image_room3='$filename' WHERE email='$customerEmail'";
                    $query_runn = mysqli_query($con, $queryy);
                    jsonResponseMain($query_runn, 'Снимакта е добавена', 'Снимката не е добавена');
                } else {
                    jsonResponse(500, 'Вече сте добавили 3 снимки');
                }
            }
        }
    } else {
        jsonResponse(500, 'Снимката, която се опитвате да добавите е по-голяма от 2MB');
    }
}

// Delete customer photo
if (isset($_POST['delete_customer_img'])) {
    $imgID = $_POST['imgId'];
    $customerEmail = $_SESSION['email'];

    if ($imgID == 1) {
        $query = "UPDATE customers SET image_room1='' WHERE email='$customerEmail'";
        $query_run = mysqli_query($con, $query);
        jsonResponseMain($query_run, 'Снимакта е изтрита', 'Снимката не е изтрита');
    } else if ($imgID == 2) {
        $query = "UPDATE customers SET image_room2='' WHERE email='$customerEmail'";
        $query_run = mysqli_query($con, $query);
        jsonResponseMain($query_run, 'Снимакта е изтрита', 'Снимката не е изтрита');
    } else if ($imgID == 3) {
        $query = "UPDATE customers SET image_room3='' WHERE email='$customerEmail'";
        $query_run = mysqli_query($con, $query);
        jsonResponseMain($query_run, 'Снимакта е изтрита', 'Снимката не е изтрита');
    }
}

// Rate services
if (isset($_POST['customer_rate'])) {

    $rating = $_POST['rating'];
    $orderId = $_POST['id'];
    $teamId = $_POST['team_id'];
    $text = $_POST['text'];

    if (!$text || !$rating) {
        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "INSERT INTO team_ratings (team_id,rating) VALUES ('$teamId','$rating')";
        $query_run = mysqli_query($con, $query);

        $query = "UPDATE orders SET customer_opinion='$text' WHERE id='$orderId'";
        $query_run = mysqli_query($con, $query);

        jsonResponseMain($query_run, 'Благодарим за вашато мнение', '');
    }
}

// Email verify
if (isset($_POST['verify'])) {

    $email = $_POST['verify'];

    $query = "UPDATE customers SET email_verify='yes' WHERE email='$email'";
    $query_run = mysqli_query($con, $query);

    jsonResponseMain($query_run, 'Успешно потвърдихте имейла си', '');
}
