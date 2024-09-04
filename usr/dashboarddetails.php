    <?php 
    include_once("../db/conf.php");
    $data = array(
        "officer" => $_POST['officerCode'],
        "officeAssign" => $_POST['officerAssign']
    );
    $jsonData = json_encode($data);
    $sql = "call getdashboarddetails(?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $jsonData);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    echo json_encode($row);
    ?>
