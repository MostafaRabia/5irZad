<?php
session_start();
?>
<form method="post" action="upload.php" enctype="multipart/form-data">
	<input type="file" name="file">
	<input type='submit' name='b'>
	<select name="type">
		<option value="فقه">فقه</option>
		<option value="حديث">حديث</option>
	</select>
</form>
<?php
include 'config.php';
include 'MP3File.php';
if ($_SESSION['login']==true){
	if (isset($_POST['b'])){
		$dir = 'audios/'.$_FILES['file']['name'];
		$allowedExts = array("mp3");
		$temp = explode(".",$_FILES["file"]["name"]);
		$name = explode('.',$_FILES['file']['name']);
		$extension = end($temp);
		if ($_FILES['file']['type']=='audio/mp3'&&in_array($extension,$allowedExts)&&isset($_POST['type'])){
			if ($_FILES['file']['error']>0){
				echo 'error<br>'.$_FILES['file']['error'];
			}else{
				if (file_exists($dir)){
		         echo $_FILES["file"]["name"]." already exists.";
		      }else{
		         move_uploaded_file($_FILES["file"]["tmp_name"],$dir);
		         $mp3file = new MP3File($dir);
		         $duration = $mp3file->getDuration();
		         $time = MP3File::formatTime($duration);
		         $result = "SELECT `id_audio` FROM `audios` WHERE `type`='$_POST[type]' ORDER BY `id_audio` DESC";
		         $query = mysqli_query($link,$result);
		         $row = mysqli_fetch_array($query);
		         $id_audio = $row['id_audio'] + 1;
		         $result1 = "INSERT INTO `audios` (`id_audio`,`type`,`name`,`duration`,`url`) VALUES ('$id_audio','$_POST[type]','$name[0]','$time','$dir')";
		         $query1 = mysqli_query($link,$result1);
		         echo 'done';
		      }
		   }
		}else{
		    echo "Invalid file";
		}
	}
}else{
	header("LOCATION: login.php");
}