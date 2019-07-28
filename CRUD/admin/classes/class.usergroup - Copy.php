<?php
/*
Simple PHP OOP Image Upload script by m0nsta.
*/
class imgUploader
{
	var $exts = array( ".png", ".gif", ".png", ".jpg", ".jpeg" ); //all the extensions that will be allowed to be uploaded
	var $maxSize = 9999999; //if you set to "0" (no quotes), there will be no limit
	var $uploadTarget = "uploads/"; //make sure you have the '/' at the end
	var $fileName = ""; //this will be automatically set. you do not need to worry about this
	var $tmpName = ""; //this will be automatically set. you do not need to worry about this
	
	public function startUpload()
	{
		$this->fileName = $_FILES['uploaded']['name'];
		$this->tmpName = $_FILES['uploaded']['tmp_name'];
		if( !$this->isWritable() )
		{
			die( "Sorry, you must CHMOD your upload target to 777!" );
		}
		if( !$this->checkExt() )
		{
			die( "Sorry, you can not upload this filetype!" );
		}
		if( !$this->checkSize() )
		{
			die( "Sorry, the file you have attempted to upload is too large!" );
		}
		if( $this->fileExists() )
		{
			die( "Sorry, this file already exists on our servers!" );
		}
		if( $this->uploadIt() )
		{
			echo "Your file has been uploaded!<br><br>Click <a href=\"" . $this->uploadTarget . time() . $this->fileName . "\">here</a> to view your file!";
		}
		else
		{
			echo "Sorry, your file could not be uploaded for some unknown reason!";
		}
	}
	
	public function uploadIt()
	{
		return ( move_uploaded_file( $this->tmpName, $this->uploadTarget . time() . $this->fileName ) ? true : false );
	}
	
	public function checkSize()
	{
		return ( ( filesize( $this->tmpName ) > $this->maxSize ) ? false : true );
	}
	
	public function getExt()
	{
		return strtolower( substr( $this->fileName, strpos( $this->fileName, "." ), strlen( $this->fileName ) - 1 ) );
	}
	
	public function checkExt()
	{
		return ( in_array( $this->getExt(), $this->exts ) ? true : false );
	}
	
	public function isWritable()
	{
		return ( is_writable( $this->uploadTarget ) );
	}
	
	public function fileExists()
	{
		return ( file_exists( $this->uploadTarget . time() . $this->fileName ) );
	}
}
$img = new imgUploader();



if( $_POST['upload_file'] )
{
	$img->startUpload();
}
else
{
	echo "<form method=\"post\" enctype=\"multipart/form-data\">
		<p>
			<label for=\"file\">Select a file to upload:</label> <input type=\"file\" name=\"uploaded\" id=\"file\"><br>
			<input type=\"submit\" name=\"upload_file\" value=\"Upload!\">
		<p>
	</form>";
}
?>