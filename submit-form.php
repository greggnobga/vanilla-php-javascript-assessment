<?php
header('Content-Type: application/json');
include "config/db.php";

$pdo = Database::getInstance();

$fullname = '';
$email = '';
$mobile = '';
$dateofbirth = '';
$gender = '';
$errors = [];

if (empty($_POST["fullname"])) {
    $errors['fullname'] = 'Name is required from php server.';
} elseif (!preg_match('/^[a-zA-Z,.\s]+$/', $_POST["fullname"])) {
    $errors['fullname'] = 'Please enter a valid full name from php server.';
} else {
    $fullname = trim($_POST["fullname"]);
}

if (empty($_POST["email"])) {
    $errors['email'] = 'Email is required from php server.';
} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email format from php server.';
} else {
    $email = trim($_POST["email"]);
}

if (empty($_POST["mobile"])) {
    $errors['mobile'] = 'Name is required from php server.';
} elseif (!preg_match('/^(?:\\+63|0)9\\d{9}$/', $_POST["mobile"])) {
    $errors['mobile'] = 'Please enter a valid mobile phone number from php server.';
} else {
    $mobile = trim($_POST["mobile"]);
}

if (empty($_POST["dateofbirth"])) {
    $errors['dateofbirth'] = 'Name is required from php server.';
} else {
    $dateofbirth = trim($_POST["dateofbirth"]);
}

if (empty($_POST["gender"])) {
    $errors['gender'] = 'Name is required from php server.';
} elseif (!preg_match('/^[a-zA-Z]+$/', $_POST["gender"])) {
    $errors['gender'] = 'Please enter a valid gender from php server.';
} else {
    $gender = trim($_POST["gender"]);
}

if (empty($errors)) {
    global $pdo;

    $stmt = $pdo->prepare('INSERT INTO users (fullname, email, mobile, dateofbirth, gender) VALUES (:fullname, :email, :mobile, :dateofbirth, :gender)');
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':dateofbirth', $dateofbirth);
    $stmt->bindParam(':gender', $gender);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to insert data into the database']);
    }
} else {
    echo json_encode(['errors' => $errors]);
}
