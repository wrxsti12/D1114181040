<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $gender = htmlspecialchars($_GET['gender']);
    $account = htmlspecialchars($_GET['account']);
    $vehicle_type = htmlspecialchars($_GET['vehicle']);}