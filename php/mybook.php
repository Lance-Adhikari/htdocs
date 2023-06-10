<!DOCTYPE html>
<html>
<head>
    <title>My Books</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/mybook.css">
</head>

<body>

<header style="background-color: #0088ff;">
    <h1>My Books</h1>
    
    <img src="../Images/logo.jpg" height="110" class="logo_move">

    <div class="BackDashboard">
        <a style="text-decoration:none;" href="../dashboard.html">Dashboard</a>
    </div>
    
    <div class="contact">
        <a style="text-decoration:none;" href="../contactUs.html">Contact Us</a>
    </div>

    <div class="about">
        <a style="text-decoration:none;" href="../aboutUs.html">About Us</a>
    </div>
</header>

<img src="../Images/logo.jpg" height="105" class="logo_move">
</body>
</html>

<?php

include 'library.php';

function GetOwnerId()
{
    $lconn = GetConnection();

    $lsql = "SELECT UserId FROM user WHERE Username = ?";

    $lstmt1 = $lconn->prepare($lsql); 

    $userName = $_SESSION['login_user'];

    $lstmt1->bind_param("s", $userName); 

    $lstmt1->execute();

    $result = $lstmt1->get_result();
    
    $ownerId = 0;

    while ($row = $result->fetch_assoc()) {
        $ownerId = $row["UserId"];
    }

    $result->free();

    $lstmt1->close();

    $lconn->close();

    return $ownerId;
}

function ListMyBook()
{
     $lconn = GetConnection();

     $lsql = "SELECT b.Title, b.Author, b.CategoryId, b.PublishedYear, b.UserId, 
                     b.Memo, b.BookId, bt.StatusId, bt.LoanerId 
                FROM book b, booktransaction bt 
                WHERE b.BookId = bt.BookId 
                    AND b.UserId = ? 
                    AND NOW() BETWEEN bt.StartDate AND bt.EndDate";

     $lstmt1 = $lconn->prepare($lsql); 

     $userId = GetOwnerId();

     $lstmt1->bind_param("d", $userId); 
 
     $lstmt1->execute();
 
     $result = $lstmt1->get_result();

     echo '<table border="1" class="resultTable">
           <tr>
                <th>Book Title</th>
                <th>Book Status</th>
                <th>Book Author</th>
                <th>Published Year</th>
                <th>Book Category</th>
                <th>Book Memo</th>
                <th>Borrower</th>
                <th>Action</th>
            </tr>';
 
     while ($row = $result->fetch_assoc()) {
        $field1name = $row["Title"];
        $field2name = GetStatusName(intval($row["StatusId"]));
        $field3name = $row["Author"];
        $field4name = $row["PublishedYear"];
        $field5name = GetCategoryName(intval($row["CategoryId"]));
        $field6name = $row["Memo"];
        $bookId = $row["BookId"];
        $loanerId = $row["LoanerId"];

        echo '
              <tr> 
                  <td class="row">'.$field1name.'</td> 
                  <td class="row">'.$field2name.'</td> 
                  <td class="row">'.$field3name.'</td>
                  <td class="row">'.$field4name.'</td> 
                  <td class="row">'.$field5name.'</td> 
                  <td class="row">'.$field6name.'</td> 
                  <td class="row">'.$loanerId.'</td>
               ';

        
        echo '<td>

            <form action="mybook.php" method="post">

            <select name="status" class="status">

                <option style="padding: 8px 5px;" id="select">Enter a status</option>

                <option value=\'1\'>Avalible</option>

                <option value=\'3\'>Borrowed</option>

                <option value=\'5\'>Lost</option>

            </select>

            <input type="hidden" name="bookId" value='.$bookId.'>

            <input type="hidden" name="loanerId" value='.$loanerId.'>

            <input type="submit" name="Update Status" value="Update Status" class="buttonstyle">

            <input type="submit" name="Update Owner" value="Update Owner" class="buttonstyle">

            </form>

        </td> ';

        echo '</tr>';
    } 
        
    echo '</table>';

    $result->free();

    $lstmt1->close();

    $lconn->close();
}

session_start();

if (strlen($_SESSION['login_userId'] <= 0)) {
    echo "<script>window.location.href='../login.html'</script>";
}

if (strlen($_SESSION['login_user']) > 0) {
    ListMyBook();
} 

if ($_POST['Update_Owner'] == "Update Owner") {
    echo '<script>confirm("Are you sure you want to change borrower to owner?")</script>'; 
    UpdateOwner($_POST['bookId'], $_POST['loanerId']);
    UpdateTransaction(1,NULL);
} 

if (strlen($_POST['Update_Status']) > 0) {

    if (strlen($_POST['status']) > 0 and strlen($_POST['bookId']) > 0) {

        $loanerId = $_POST['loanerId'];

        if ($_POST['status'] == 1 or $_POST['status'] == 5) {
            $loanerId = NULL;
        }

        UpdateTransaction($_POST['status'], $loanerId);
    }
}

?>