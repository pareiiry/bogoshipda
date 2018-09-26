<?php
for ($i=0; $i<count($_FILES['filesToUpload']['name']); $i++){
    $ar = array();
    foreach (array_keys($_FILES['filesToUpload']) as $arr){
        $ar[$arr] = $_FILES['filesToUpload'][$arr][$i];
    }
//    $imgGroupID = uniqid();
//    echo $imgGroupID;
    echo $_FILES['filesToUpload']['tmp_name'][$i];echo "<br>";
    $db = mysqli_connect("localhost","root","","bogoshipdadb2"); //keep your db name
    $image = addslashes(file_get_contents($_FILES['filesToUpload']['tmp_name'][$i]));
//you keep your column name setting for insertion. I keep image type Blob.
    $query = "INSERT INTO image (imgID,img) VALUES('','$image')";
    $qry = mysqli_query($db, $query);

    //imager($ar);
//    print_r($ar);
//    echo "<br>";

}
//echo "<br>";
//print_r($_FILES['filesToUpload']['tmp_name']);
//echo "<br>";








//---query-----//
//if(count($_FILES['filesToUpload']['name'])) {
//    $i = 0;
//    foreach ($_FILES['filesToUpload']['name'] as $file) {
//        $img = "uploads/clients/".$file;
//        move_uploaded_file($_FILES['filesToUpload']['tmp_name'][$i], $img);
//        chmod( $img , 0777 );
//
//        $company = $_POST['exsistingcompanies'];
//
//        $time = strtotime($row[time] . ' + 3 hours');
//        $time = date("m/d/y - h:i a", $time);
//
//        $query = "INSERT INTO media_files SET client_id='$company', name='$img', date_uploaded='$time'";
//        queryMysql($query);
//        $i++;
//    }
//}
