<?php 
    include("../../db/conf.php"); 
    session_start();
    $spname = $_POST["spname"];
    $data = $_POST["jsonData"];
    $sql = "call ".$spname."(?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $data);
    // START HERE
    if(strtoupper($spname) == "GETEMPLOYEE") {
        if($stmt->execute()){
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                echo "
                <tr>
                    <td class='text-start'>".$row['usercode']."</td>
                    <td class='text-start'>" . strtoupper($row['fullname']) . "</td>
                    <td class='text-start'>" . strtoupper($row['office']) . "</td>
                    <td class='text-start'>" . strtoupper($row['email']) . "</td>
                    <td class='text-start'>".$row['phonenumber']."</td>
                </tr>
                ";
            }
        }
    }
    if(strtoupper($spname) == "GETDOCUMENT_INCOMING") {
        if($stmt->execute()){
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                echo "
                <tr class='table-row' data-row-id='".$row['transactioncode']."' onmouseover=\"this.style.cursor='pointer';\"'>
                    <td class='text-start'>".$row['transactioncode']."</td>
                    <td class='text-start'>".$row['officer']."</td>
                    <td class='text-start'>" . strtoupper($row['docdescription']) . "</td>
                    <td class='text-start'>" . strtoupper($row['docpurpose']) . "</td>
                    <td class='text-start'>" . strtoupper($row['officeinvolved']) . "</td>
                    <td class='text-start'>".$row['forwardedto']."</td>
                    <td class='text-start'>".$row['urgencylevel']."</td>
                    <td class='text-start'>".$row['dateadded']."</td>
                </tr>
                ";
            }
        }
    }

    if(strtoupper($spname) == "GETDOCUMENT_RECEIVED") {
        if($stmt->execute()){
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                echo "
                <tr class='table-row' data-row-id='".$row['transactioncode']."' onmouseover=\"this.style.cursor='pointer';\"'>
                    <td class='text-start'>".$row['transactioncode']."</td>
                    <td class='text-start'>".$row['officer']."</td>
                    <td class='text-start'>" . strtoupper($row['docdescription']) . "</td>
                    <td class='text-start'>" . strtoupper($row['docpurpose']) . "</td>
                    <td class='text-start'>" . strtoupper($row['officeinvolved']) . "</td>
                    <td class='text-start'>".$row['forwardedto']."</td>
                    <td class='text-start'>".$row['urgencylevel']."</td>
                    <td class='text-start'>".$row['dateadded']."</td>
                </tr>
                ";
            }
        }
    }

    if(strtoupper($spname) == "GETDOCUMENT_OUTGOING") {
        if($stmt->execute()){
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                switch($row['status']){
                    case "IN-PROGRESS":
                        $bgcolor = "darkorange";
                        break;
                    case "ON-HOLD":
                        $bgcolor = "lightgray";
                        break;
                    case "WAITING":
                        $bgcolor = "blue";
                        break;
                }
                echo "
                <tr class='table-row' data-row-id='".$row['transactioncode']."'>
                    <td class='text-start'>".$row['transactioncode']."</td>
                    <td class='text-start'>".$row['officer']."</td>
                    <td class='text-start'>" . strtoupper($row['docdescription']) . "</td>
                    <td class='text-start'>" . strtoupper($row['docpurpose']) . "</td>
                    <td class='text-start'>" . strtoupper($row['officeinvolved']) . "</td>
                    <td class='text-start'>".$row['urgencylevel']."</td>
                    <td class='text-start'>".$row['dateadded']."</td>
                    <td class='text-center'><span style='background:".$bgcolor.";padding: 3px 15px;border-radius:15px;color:#fff;'>".$row['status']."</span></td>
                </tr>
                ";
            }
        }
    }

    if(strtoupper($spname) == "GETDOCUMENT_COMPLETED") {
        if($stmt->execute()){
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                switch($row['status']){
                    case "COMPLETE":
                        $bgcolor = "green";
                        break;
                    case "RETURNED":
                        $bgcolor = "red";
                        break;
                }
                echo "
                <tr class='table-row' data-row-id='".$row['transactioncode']."'>
                    <td class='text-start'>".$row['transactioncode']."</td>
                    <td class='text-start'>".$row['officer']."</td>
                    <td class='text-start'>" . strtoupper($row['docdescription']) . "</td>
                    <td class='text-start'>" . strtoupper($row['docpurpose']) . "</td>
                    <td class='text-start'>" . strtoupper($row['officeinvolved']) . "</td>
                    <td class='text-start'>".$row['urgencylevel']."</td>
                    <td class='text-start'>".$row['dateadded']."</td>
                    <td class='text-center'><span style='background:".$bgcolor.";padding: 3px 15px;border-radius:15px;color:#fff;'>".$row['status']."</span></td>
                </tr>
                ";
            }
        }
    }

    if(strtoupper($spname) == "GETDOCUMENT_REQUEST" || strtoupper($spname) == "GETDOCUMENT_PROCESSED") {
        if($stmt->execute()){
            $bgcolor = "";
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                switch($row['status']){
                    case "APPROVED":
                        $bgcolor = "green";
                        break;
                    case "DECLINED":
                        $bgcolor = "red";
                        break;
                    case "IN-PROGRESS":
                        $bgcolor = "darkorange";
                        break;
                    case "ON-HOLD":
                        $bgcolor = "lightgray";
                        break;
                    case "WAITING":
                        $bgcolor = "blue";
                        break;
                    case "PENDING":
                        $bgcolor = "purple";
                        break;
                    case "FOR EDIT":
                        $bgcolor = "lightpink";
                        break;
                    case "COMPLETE":
                        $bgcolor = "green";
                        break;
                }
                echo "
                <tr class='table-row' data-row-id='".$row['transactioncode']."'>
                    <td class='text-start'>".$row['transactioncode']."</td>
                    <td class='text-start'>" . strtoupper($row['docdescription']) . "</td>
                    <td class='text-start'>" . strtoupper($row['docpurpose']) . "</td>
                    <td class='text-start'>" . strtoupper($row['officeinvolved']) . "</td>
                    <td class='text-start'>".$row['urgencylevel']."</td>
                    <td class='text-center'><span style='background:".$bgcolor.";padding: 3px 15px;border-radius:15px;color:#fff;'>".$row['status']."</span></td>
                </tr>
                ";
            }
        }
    }

    if(strtoupper($spname) == "GETDOCUMENTPROGRESS") {
        if($stmt->execute()){
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                echo "
                <tr class='table-row'>
                    <td class='text-start'>" . strtoupper($row['forwarded_to']) ."</td>
                    <td class='text-start'>" . strtoupper($row['description']) ."</td>
                    <td class='text-start'>" . strtoupper($row['note']) . "</td>
                    <td class='text-start'>" . strtoupper($row['entereddate']) . "</td>
                </tr>
                ";
            }
        }
    }
    $stmt->close();
    $con->close();
?>