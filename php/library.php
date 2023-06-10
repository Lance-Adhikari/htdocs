<?php
    include 'config.php';

    function GetUserInfoById($Id)
    {
        $lconn = GetConnection();

        $lstmt1 = $lconn->prepare("SELECT * FROM user WHERE UserId=?");

        $lstmt1->bind_param("d", $Id);

        $lstmt1->execute();

        $result = $lstmt1->get_result();
        
        $lUserInfo = $result->fetch_assoc();

        $lstmt1->close();

        $lconn->close();

        //printf("%s %d \n", $lUserInfo['UserStatus'], $Id);

        return $lUserInfo;
    }

    function GetStatusName($statusId)
    {
        $lconn = GetConnection();

        $lsql = "SELECT StatusName FROM status WHERE StatusId = ?";

        $lstmt1 = $lconn->prepare($lsql); 

        $lstmt1->bind_param("i", $statusId); 

        $lstmt1->execute();

        $result = $lstmt1->get_result();

        while ($row = $result->fetch_assoc()) {
            $statusName = $row["StatusName"];
        }

        $result->free();

        $lstmt1->close();

        $lconn->close();

        return $statusName;
    }

    function GetCategoryName($categoryId)
    {
        $lconn = GetConnection();

        $lsql = "SELECT CategoryName FROM category WHERE CategoryId = ?";

        $lstmt1 = $lconn->prepare($lsql); 

        $lstmt1->bind_param("i", $categoryId); 

        $lstmt1->execute();

        $result = $lstmt1->get_result();

        while ($row = $result->fetch_assoc()) {
            $categoryName = $row["CategoryName"];
        }

        $result->free();

        $lstmt1->close();

        $lconn->close();

        return $categoryName;
    }

    function UpdateTransaction($StatusId, $LoanerId)
    {
        $lConn = GetConnection();

        $lStmt = $lConn->prepare("UPDATE booktransaction 
                    SET EndDate = ? WHERE BookId = ? AND SYSDATE() BETWEEN StartDate AND EndDate");

        //assigning

        $bookId = $_POST['bookId'];

        $endDate = date('Y-m-d H:i:s');

        if ($lStmt->bind_param("sd", $endDate, $bookId) == FALSE) {
            echo "Bind failed on update " . $lStmt->error;
            exit();
        }

        if (!$lStmt->execute()) {
            echo "Execute failed on update " . $lStmt->error;
            exit();
        }

        $lStmt->close();

        $lStmt1 = $lConn->prepare("INSERT INTO booktransaction VALUES (?, ?, ?, ?, ?)");

        $startDate = date('Y-m-d H:i:s');

        $endDate = date('9999-9-9 0:0:0');

        if ($lStmt1->bind_param("dssdd", $bookId, $startDate, $endDate, $LoanerId, $StatusId) == FALSE) {
            echo "Bind failed on insert " . $lStmt1->error;
            exit();
        }

        if (!$lStmt1->execute()) {
            echo "Execute failed on insert " . $lStmt1->error;
            exit();
        }
   
        $lStmt1->close();
   
        $lConn->close();
    }

    
    function UpdateOwner($BookId, $LoanerId)
    {
        $lConn = GetConnection(); 

        $lStmt = $lConn->prepare("UPDATE book SET UserId = ? WHERE BookId = ?");

        //assigning

        $bookId = $_POST['bookId'];

        $endDate = date('Y-m-d H:i:s');

        if ($lStmt->bind_param("dd", $LoanerId, $BookId) == FALSE) {
            echo "Bind failed on update " . $lStmt->error;
            exit();
        }

        if (!$lStmt->execute()) {
            echo "Execute failed on update " . $lStmt->error;
            exit();
        }

        $lStmt->close();
   
        $lConn->close();
    }

    function SetUserStatus($UserId, $Value)
    {
        $lConn = GetConnection();

        $lStmt = $lConn->prepare("UPDATE user SET UserStatus = ? WHERE UserId = ?");

        //assigning

        if ($lStmt->bind_param("sd", $Value, $UserId) == FALSE) {
            echo "Bind failed on update " . $lStmt->error;
            exit();
        }

        if (!$lStmt->execute()) {
            echo "Execute failed on update " . $lStmt->error;
            exit();
        }

        $lStmt->close();

        $lConn->close();
    }

    function UpdateUserInfo($UserId, $Value)
    {
        $lConn = GetConnection();

        $lStmt = $lConn->prepare("UPDATE user SET UserStatus = ? WHERE UserId = ?");

        //assigning

        if ($lStmt->bind_param("sd", $Value, $UserId) == FALSE) {
            echo "Bind failed on update " . $lStmt->error;
            exit();
        }

        if (!$lStmt->execute()) {
            echo "Execute failed on update " . $lStmt->error;
            exit();
        }

        $lStmt->close();

        $lConn->close();
    }
?>