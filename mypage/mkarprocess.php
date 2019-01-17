<?php
//db 설정
require("./db.php");
require("./config.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

// 설정
$uploads_dir = './img';
$allowed_ext = array('jpg','jpeg','png','gif');
 
// 변수 정리
$error = $_FILES['myfile']['error'];
$name = $_FILES['myfile']['name'];
$ext = array_pop(explode('.', $name));
$category = mysqli_real_escape_string($conn,$_POST['category']);
// 오류 확인
if( $error != UPLOAD_ERR_OK ) {
	switch( $error ) {
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			echo "파일이 너무 큽니다. ($error)";
			break;
		case UPLOAD_ERR_NO_FILE:
			echo "파일이 첨부되지 않았습니다. ($error)";
			break;
		default:
			echo "파일이 제대로 업로드되지 않았습니다. ($error)";
    }
    header('Location: ./index.php');
	exit;
}
 
// 확장자 확인
if( !in_array($ext, $allowed_ext) ) {
	echo "허용되지 않는 확장자입니다.";
    header('Location: ./index.php');
    exit;
}
//
$sql_name = '<img src="./img/'.$name.'" alt="imglist" class="img-thumbnail rounded">';
echo $sql_name;
$sql = "insert into descrip values ('".$category."','".$sql_name."')";

mysqli_query($conn,$sql);
// 파일 이동
move_uploaded_file( $_FILES['myfile']['tmp_name'], "$uploads_dir/$name");
header('Location: ./index.php');
exit;
?>