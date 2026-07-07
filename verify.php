<?php
// Always start this first
session_start();

if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['password'] ) ) {
    	if ( $_POST['password'] == "Quest1!" ) {
    		$_SESSION['password'] = true;
            header("Location: admin_page.php");
    	} else {
            header("Location: admin_page.php");
        }
    } else {
        header("Location: admin_page.php");
    }
}
?>