<?php
include "config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Insert</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/insert.css">
</head>

<body>

<header style="background-color: #0088ff;">
    <h1>Book Insert</h1>
    
    <img src="../Images/logo.jpg" height="110" class="logo_move">

    <a style="text-decoration:none;" href="../dashboard.html" class="BackDashboard">Dashboard</a>

    <div class="contact">
        <a style="text-decoration:none;" href="../contactUs.html">Contact Us</a>
    </div>

    <div class="about">
        <a style="text-decoration:none;" href="../aboutUs.html">About Us</a>
    </div>
</header>

<p class="required">Please Enter All * Fields</p>

<div id="dashbox"> 
</div>

<div class="formCon">
    <form action="BookInsert.php" method="post">

        <br> </br>
        <br> </br>

        <p class="booktitle">
        <label>*Title:</label>
        <input class="boxalign" name="booktitle" type="text" style="padding: 8px 5px;" required>
        </p>

        <br> </br>
        <br> </br>

        <p class="bookauthor">
        <label>*Author:</label>
        <input class="boxalign" name="bookauthor" type="text" style="padding: 8px 5px;" required>
        </p>

        <br> </br>
        <br> </br>

        <p class="publishedyear">
        <label>Publication:</label>
        <input class="boxalign" name="publishedyear" type="number" placeholder="YYYY" min="1800" max="2099" style="padding: 8px 5px;">
        </p>

        <br> </br>
        <br> </br>

        <p class="memo">
        <label>Memo:</label>
        <input class="boxalign" name="memo" type="text" style="padding: 8px 5px;">
        </p>

        <br> </br>
        <br> </br>

        <p class="isbn">
        <label>ISBN:</label>
        <input class="boxalign" name="isbn" type="tel" style="padding: 8px 5px;">
        </p>

        <br> </br>
        <br> </br>

        <p class="barcode">
        <label>Barcode:</label>
        <input class="boxalign" name="barcode" type="text" style="padding: 8px 5px;">
        </p>

        <br> </br>
        <br> </br>

        <p class="category">

            <label for="subject">*Category:</label>

            <select class="boxalign" name="category" id="sel_category" style="padding: 8px 5px;" required>
                <option></option> 

                <?php 
                
                    $lconn = GetConnection();

                    // Fetch Department
                    $sql_category = "SELECT * FROM category";

                    $category_data = mysqli_query($lconn,$sql_category);

                    while($row = mysqli_fetch_assoc($category_data) ){
                        $categoryid = $row['CategoryId'];
                        $category_name = $row['CategoryName'];

                        // Option
                        echo "<option value='".$categoryid."' >".$category_name."</option>";
                    } 

                    $lconn->close();
                ?>
            </select>
            </p>

        <br> </br>
        <br> </br>

        <button class="buttonstyle">Insert</button>
    </form>
    </div>
</body>
</html>

<?php

session_start();

if (strlen($_SESSION['login_userId'] <= 0)) {
    echo "<script>window.location.href='../login.html'</script>";
}

function InsertBook()
{
     //printf("hi %s \n", $_SESSION['login_user']);

     //connection 

     $lconn = GetConnection();

     //qurey select the max id

     $lsql = "SELECT MAX(BookId) FROM book"; 

     $lstmt = $lconn->prepare($lsql); 
 
     $lstmt->execute();
 
     $result = $lstmt->get_result();

     $myrow = $result->fetch_row();

     $lstmt->close();

     $NewBookId = intval($myrow[0])+1;

     //qurey 

     $lsql1 = "SELECT UserId FROM user WHERE Username = ?"; 

     $lstmt2 = $lconn->prepare($lsql1); 

     $username = $_SESSION['login_user'];

     if (strlen($username < 0)) {
        die("Session Expired, Please Relogin");
     }

     $lstmt2->bind_param("s", $username); 
 
     $lstmt2->execute();
 
     $result1 = $lstmt2->get_result();

     $myrow1 = $result1->fetch_row();

     $lstmt2->close();

     $userId = $myrow1[0];

     //

     // need a validation 

     $lstmt1 = $lconn->prepare("INSERT INTO book (BookId,Title,Author,CategoryId,PublishedYear,StatusId,Barcode,UserId,
                                Memo,Isbn) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
     //assigning

     $bookTitle = $_POST['booktitle'];

     $bookAuthor = $_POST['bookauthor'];

     $catId = intval($_POST['category']);

     $publishedYear = $_POST['publishedyear'];

     $statusId = 1;

     $barcode = $_POST['barcode'];

     $memo = $_POST['memo'];

     $isbn = $_POST['isbn'];

     //

     $rc=$lstmt1->bind_param("dssdddsdsd", $NewBookId, $bookTitle, $bookAuthor, $catId, $publishedYear, $statusId, $barcode, $userId, $memo, $isbn);

     if ($rc === FALSE) {
         printf("bindnotsuccesfull %s \n", $lstmt1->error);
     }

     $rc = $lstmt1->execute();

     if ($rc === FALSE) {
        printf("executenotsuccesfull %s \n", $lstmt1->error);
    }

     if ($rc === TRUE) {
         echo '<script>alert("Book Succesfully Inserted")</script>';
     }

     $lstmt1->close();

     $lconn->close();

     return $NewBookId;
}

function InsertBooktransaction($lBookId) 
{
    $lConn = GetConnection();

    $lSql = "INSERT INTO booktransaction (BookId, StartDate, EndDate, StatusId) VALUES (?, ?, ?, ?)";

    if($lStmt = $lConn->prepare($lSql)) {

        if ($lStmt->bind_param("dssd", $lBookId, $startDate, $endDate, $statusId) == FALSE) {
            echo "Could not bind parameters" . $lStmt->error;
            exit();
        }

        //assigning

        $startDate = date('Y-m-d H:i:s');

        $statusId = 1;

        $endDate = date('9999-9-9 0:0:0');

        if (!$lStmt->execute()) {
            echo "Could not execute" . $lStmt->error;
        }
    }

    else {
        echo "Could not prepare sql query" . $lStmt->error;
    }
   
    $lStmt->close();
   
    $lConn->close();  
}

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if((strlen($_POST['booktitle']) > 0) and (strlen($_POST['bookauthor']) > 0)) {
        $lBookId = InsertBook();
        InsertBooktransaction($lBookId);
    }
    else {
        if (array_key_exists('booktitle', $_POST)) {
            echo '<script>alert("Please enter the all the fields")</script>'; 
        }
    }
}
?>