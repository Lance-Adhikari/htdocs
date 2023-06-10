<?php
session_start();

if (strlen($_SESSION['login_userId'] <= 0)) {
    echo "<script>window.location.href='../login.html'</script>";
}
?>