<?php

# already contains config.php
require 'library.php';

function GetOwnerName($ownerId)
{
    $lconn = GetConnection();

    $lsql = "SELECT FirstName, LastName FROM user WHERE UserId = ?";

    $lstmt1 = $lconn->prepare($lsql); 

    $lstmt1->bind_param("d", $ownerId); 

    $lstmt1->execute();

    $result = $lstmt1->get_result();

    $fullName = ""; 

    while ($row = $result->fetch_assoc()) {
        $firstName = $row["FirstName"];
        $lastName = $row["LastName"];
    }

    $fullName = $firstName." ".$lastName;

    $result->free();

    $lstmt1->close();

    $lconn->close();

    return $fullName;
}

function QueryBook($lsql, $keyword)
{
     $lConn = GetConnection();

     $lstmt1 = $lConn->prepare($lsql); 

     $lstmt1->bind_param("s", $keyword); 
 
     $lstmt1->execute();
 
     $result = $lstmt1->get_result();

     echo '<table border="1" align="center" class="resultTable">
           <tr>
                <th>Book Title</th>
                <th>Book Status</th>
                <th>Book Author</th>
                <th>Published Year</th>
                <th>Book Category</th>
                <th>Book Memo</th>
                <th>Owner Of Book</th>
                <th>Action</th>
            </tr>';
 
     while ($row = $result->fetch_assoc()) {
        $bookTitle = $row["Title"];
        $bookStatus = GetStatusName(intval($row["StatusId"]));
        $statusId = $row["StatusId"];
        $bookAuthor = $row["Author"];
        $bookYear = $row["PublishedYear"];
        $bookCategory = GetCategoryName(intval($row["CategoryId"]));
        $bookMemo = $row["Memo"];
        $bookOwnerId = $row["UserId"];
        $bookId = $row["BookId"];
        $fullName = GetOwnerName($bookOwnerId);

        echo '
              <tr> 
                  <td class="row">'.$bookTitle.'</td> 
                  <td class="row">'.$bookStatus.'</td> 
                  <td class="row">'.$bookAuthor.'</td>
                  <td class="row">'.$bookYear.'</td> 
                  <td class="row">'.$bookCategory.'</td> 
                  <td class="row">'.$bookMemo.'</td> 
                  <td class="row">'.$fullName.'</td>
               ';

        if ($bookStatus == 'Available') {
            echo '<td>

                <form action="emailsend.php" method="post">

                <input type="hidden" name="bookOwnerId" value='.$bookOwnerId.'>

                <input type="hidden" name="bookId" value='.$bookId.'>

                <input type="hidden" name="title" value='.$bookTitle.'>

                <input type="hidden" name="author" value='.$bookAuthor.'>

                <input type="hidden" name="status" value='.$bookStatus.'>

                <input type="hidden" name="statusId" value='.$statusId.'>

                <button>Borrow</button>

                </form>

            </td> ';
            
        }
        else {
            echo '<td><button disabled>Borrow</button></td>';
        }

        echo '</tr>';
    } 
        
    echo '</table>';

    $result->free();

    $lstmt1->close();

    $lConn->close();

}

function SearchBook()
{
     if ($_POST['subject'] == 'Book Title' and strlen($_POST['keyword']) > 0)
     {
         $keyword = $_POST['keyword'];
         $lsql = "SELECT * FROM book WHERE Title = ?";
     }
     elseif ($_POST['subject'] == 'Book Author' and strlen($_POST['keyword']) > 0)
     {
         $keyword = $_POST['keyword'];
         $lsql = "SELECT * FROM book WHERE Author = ?";
     }
     elseif ($_POST['subject'] == 'Published Year' and strlen($_POST['keyword']) > 0)
     {
         $keyword = $_POST['keyword'];
         $lsql = "SELECT * FROM book WHERE PublishedYear = ?";
     }
     elseif ($_POST['subject'] == 'Book Category' and strlen($_POST['keyword']) > 0)
     {
         $keyword = $_POST['keyword'];
         $lsql = "SELECT * FROM book WHERE CategoryId = ?";
     }
     elseif ($_POST['subject'] == 'Book Memo' and strlen($_POST['keyword']) > 0)
     {
         $keyword = $_POST['keyword'];
         $lsql = "SELECT * FROM book WHERE Memo = ?";
     }
     elseif (strlen($_POST['keyword']) > 0) {
        $keyword = "%". $_POST['keyword']. "%";
        $lsql = "SELECT b.Title, b.Author, b.CategoryId, b.PublishedYear, b.UserId, b.Memo, b.BookId, bt.StatusId 
        FROM book b, booktransaction bt 
        WHERE b.BookId = bt.BookId AND b.Title LIKE ? AND NOW() BETWEEN bt.StartDate AND bt.EndDate";
     } 
     
     QueryBook($lsql, $keyword);
}

session_start();

if (strlen($_SESSION['login_userId'] <= 0)) {
    echo "<script>window.location.href='../login.html'</script>";
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    SearchBook();
}

?>