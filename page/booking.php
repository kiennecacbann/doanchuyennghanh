<?php
use PHPMailer\PHPMailer\PHPMailer;
if (isset($_POST['booking'])) {
    $occasion = $_POST['occasion'];
    $aop = $_POST['aop'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $user_id = $_SESSION['khachhang_id'];
    $note = $_POST['note'];
    $room_id = $_POST['room_id'];
    $table_cat = $_POST['table_cat'];
    $today = date("Y-m-d");
    $today1 = date("H:m:s");
    if($aop <= 0){    
        echo '<script language="javascript">';
        echo 'alert("SỐ LƯỢNG KHÁCH KHÔNG HỢP LỆ")';
        echo '</script>';  
    }else if($date <= $today ){
        echo '<script language="javascript">';
        echo 'alert("NGÀY KHÔNG HỢP LỆ")';
        echo '</script>'; 
    }else if($date <= $today ){
        echo '<script language="javascript">';
        echo 'alert("NGÀY KHÔNG HỢP LỆ")';
        echo '</script>'; 
    }
    else{         
        $sql_insert_donhang = mysqli_query($con,"INSERT INTO tbl_table_booking(date,aop,user_id,occasion,status,time,note,room_id,table_cat)
    values('$date','$aop','$user_id','$occasion','0','$time','$note','$room_id','$table_cat')");
        echo '<script language="javascript">';
        echo 'alert("CHÚNG TÔI ĐÃ GHI NHẬN PHIẾU ĐẶT BÀN CỦA BẠN")';
        echo '</script>'; 
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIEN RESTAURANT</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/webstyle.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrer-policy="no-referrer" />
    <script>
        src = "https://kit.fontawesome.com/54f0cb7e4a.js";
        crossorigin = "anonymous"
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
<section id='booking' class="booking section-padding">
        <div class="container">
            <div class="row">
                <div class="title">
                <h2 style="color: #DAA520;">BOOKING</h2>
                </div>
            </div>
            <div class="booking-form">
                <form class="" action="./home.php" method="post">
                    <h1>BOOKING FORM</h1>
                    <p>PLEASE FILL OUT ALL FIELDS. THANKS!</p>
                    <div class="row justify-content">

                        <div class="booking-form-item">
                             <p>Table for ?</p>
                            <select id="table_cat" name="table_cat" required>                              
                                        <option value="2">2</option>     
                                        <option value="5">5</option>   
                                        <option value="10">10</option>                                                                                                               
                            </select>
                        </div>

                        <div class="booking-form-item">
                            <p>Note</p>
                            <input type="text" placeholder="note" id="note" name="note" required>
                        </div>

                        <div class="booking-form-item">
                            <p>Room you want to use</p>
                            <select id="room_id" name="room_id" required>
                                <?php
                                     $sql_select_room = mysqli_query($con, "SELECT * FROM tbl_room WHERE current_table < table_amount ");
                                    while($row_room = mysqli_fetch_array($sql_select_room)){
                                        ?>
                                        <option value="<?php echo $row_room['id'];?>"><?php echo $row_room['name'];?></option>                                  
                                    <?php
                                    }
                                    $row_room = mysqli_num_rows($sql_select_room);
                                    if($row_room <= 0)
                                        echo'<option value="0">Out of room</option>';
                                    ?>
                            </select>
                        </div>
                      
                        
                        <div class="booking-form-item">
                            <p>Number of guests
                            <p>
                                <input type="number" placeholder="Quantity" id="aop" name="aop" required>
                        </div>
                        
                        <div class="booking-form-item">
                            <p>Date</p>
                            <input type="date" id="date" name="date" required>
                        </div>
                        <div class="booking-form-item">
                            <p>Time</p>
                            <input type="time" id="time" name="time" required>
                        </div>
                    </div>
                    <button type="submit" name="booking">SUBMIT</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>