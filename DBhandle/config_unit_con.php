<?php 
    if(isset($_GET["code"])){
        $code=$_GET["code"];
        switch($code){
            case "save":
                    save();
                    break;

                case "get_data":
                    getdata();
                    break;

                case "get_uheadidselect_data":
                    get_uheadidselect_data();
                    break;
    
                case "get_uheadnameselect_data":
                    get_uheadnameselect_data();
                    break;
            }
        }

        function save(){
            $unitno = $_POST["uno"];
            $unitname = $_POST["uname"];
            $location = $_POST["loc"];
            $unitheadid = $_POST["uheadid"];
            $unitheadname = $_POST["uheadname"];
            $unitemail = $_POST["uemail"]; 
            $unittel = $_POST["utel"];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "nhk_epms";
            
                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $db);
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                

                $sql1 ="SELECT Unit_no FROM epms_unit ORDER BY Unit_sn DESC LIMIT 1 ";
                $result1=mysqli_query($conn,$sql1);

                $rowcount=mysqli_num_rows($result1);

                if ($rowcount>0) {
                    $row = mysqli_fetch_assoc($result1);
                    $last_id = $row["Unit_no"];
                }

                $unt_number = substr($last_id,2,6);
                $newunt_number = str_pad(intval($unt_number) + 1, strlen($unt_number),'0', STR_PAD_LEFT);
                $new_untid = "UN".$newunt_number;


                $sql = "INSERT INTO `epms_unit`(`Unit_no`,`Unit_name`,`Location`,`Unit_head_id`,
                `Unit_head_name`,`Unit_email`,`Unit_telephone`)
            VALUES ('$new_untid','$unitname','$location','$unitheadid','$unitheadname','$unitemail','$unittel')";

            $result = mysqli_query($conn, $sql);

            if (!$result) {
                echo mysqli_error($conn);
            }
            else{
                echo "success";
            }
        }


        function getdata(){
            $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "nhk_epms";
                
                    // Create connection
                    $conn = mysqli_connect($servername, $username, $password, $db);
                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    
                    
                    $sql = "select * from `epms_unit`";
                    
                    
                    $result = mysqli_query($conn, $sql);
    
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr><td>" . $row["Unit_sn"] . "</td><td>" . $row["Unit_name"] . "</td>
                            <td>" . $row["Location"] . "</td>
                            <td>" . $row["Unit_head_id"] . "</td>
                            <td>" . $row["Unit_head_name"] . "</td><td>" . $row["Unit_email"] . "</td>
                            <td>" . $row["Unit_telephone"] . "</td>
                            <td>
                                <ul class='icons-list'>
                                    <li><a><i class='icon-pencil7'></i></a></li>
                                    <li><a><i class='icon-trash'></i></a></li>
                                </ul>
                            </td>
                            </tr>";
                        }
                    } else {
                        echo "0 results";
                    }
    
        }
    


        function  get_uheadidselect_data(){
                $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "nhk_epms";
                
                    // Create connection
                    $conn = mysqli_connect($servername, $username, $password, $db);
                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    
                    
                    $sql = "select * from `epms_employee`";
                    
                    
                    $result = mysqli_query($conn, $sql);
    
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option>" . $row["Emp_id"] . "</option>";
                        }
                    } else {
                        echo "0 results";
                    }
        }
    
        function get_uheadnameselect_data(){
            $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "nhk_epms";
                
                    // Create connection
                    $conn = mysqli_connect($servername, $username, $password, $db);
                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    
                    
                    $sql = "select * from `epms_employee`";
                    
                    
                    $result = mysqli_query($conn, $sql);
    
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option>" . $row["Emp_name"] . "</option>";
                        }
                    } else {
                        echo "0 results";
                    }
        }


        

?>