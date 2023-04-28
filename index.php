<?php
/* 

Free PHP File Directory Listing Script - Version 1.10

The MIT License (MIT)

Copyright (c) 2015 Hal Gatewood

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.


*** OPTIONS ***/

	// TITLE OF PAGE
	$title = "List of Files";
	
	// STYLING (light or dark)
	$color	= "light";
	
	// ADD SPECIFIC FILES YOU WANT TO IGNORE HERE
	$ignore_file_list = array( ".htaccess", "Thumbs.db", ".DS_Store", "index.php" );
	
	// ADD SPECIFIC FILE EXTENSIONS YOU WANT TO IGNORE HERE, EXAMPLE: array('psd','jpg','jpeg')
	$ignore_ext_list = array( );
	
	// SORT BY
	$sort_by = "name_asc"; // options: name_asc, name_desc, date_asc, date_desc
	
	// ICON URL
	$icon_url = "flat.png"; // DIRECT LINK
	
	// TOGGLE SUB FOLDERS, SET TO false IF YOU WANT OFF
	$toggle_sub_folders = true;
	
	// FORCE DOWNLOAD ATTRIBUTE
	$force_download = true;
	
	// IGNORE EMPTY FOLDERS
	$ignore_empty_folders = true;

	// HASHED PASSWORD TO PRETECT PAGE ACCESS - IF NO SETTED OR SETTED EMPTY ($hashed_password = '') NO LOGIN WILL BE REQUIRED
	// $hashed_password = '$2a$12$D6yPHthNtMXLwZtaWOzore53MbDMRsXfe3mEFg//yEKaosrpa47jS'; // HASHED PASSWORD 'guest'
	$hashed_password = '';

	
// SET TITLE BASED ON FOLDER NAME, IF NOT SET ABOVE
if( !$title ) { $title = clean_title(basename(dirname(__FILE__))); }
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,maximum-scale=1.0, viewport-fit=cover">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
	<link href="//fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet" type="text/css" />
	<style>
		*, *:before, *:after { -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; }
		body { background: #dadada; font-family: "Lato", "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; font-weight: 400; font-size: 14px; line-height: 18px; padding: 0; margin: 0; text-align: center;}
		.wrap { max-width: 100%; width: 500px; margin: 20px auto; background: white; padding: 40px; border-radius: 3px; text-align: left;}
		@media only screen and (max-width: 700px) { .wrap { padding: 15px; } }
		h1 { text-align: center; margin: 40px 0; font-size: 22px; font-weight: bold; color: #666; }
		a { color: #399ae5; text-decoration: none; } a:hover { color: #206ba4; text-decoration: none; }
		.note { padding:  0 5px 25px 0; font-size:80%; color: #666; line-height: 18px; }
		.block { clear: both; min-height: 50px; border-top: solid 1px #ECE9E9; }
		.block:first-child { border: none; }
		.block .img { width: 50px; height: 50px; display: block; float: left; margin-right: 10px; background: transparent url(<?php echo $icon_url; ?>) no-repeat 0 0; }
		.block .file { padding-bottom: 5px; }
		.block .data { line-height: 1.3em; color: #666; }
		.block a { display: block; padding: 20px; transition: all 0.35s; }
		.block a:hover, .block a.open { text-decoration: none; background: #efefef; }
		
		.bold { font-weight: 900; }
		.upper { text-transform: uppercase; }
		.fs-1 { font-size: 1em; } .fs-1-1 { font-size: 1.1em; } .fs-1-2 { font-size: 1.2em; } .fs-1-3 { font-size: 1.3em; } .fs-0-9 { font-size: 0.9em; } .fs-0-8 { font-size: 0.8em; } .fs-0-7 { font-size: 0.7em; }
		
		.jpg, .jpeg, .gif, .png { background-position: -50px 0 !important; } 
		.pdf { background-position: -100px 0 !important; }  
		.txt, .rtf { background-position: -150px 0 !important; }
		.xls, .xlsx { background-position: -200px 0 !important; } 
		.ppt, .pptx { background-position: -250px 0 !important; } 
		.doc, .docx { background-position: -300px 0 !important; }
		.zip, .rar, .tar, .gzip { background-position: -350px 0 !important; }
		.swf { background-position: -400px 0 !important; } 
		.fla { background-position: -450px 0 !important; }
		.mp3 { background-position: -500px 0 !important; }
		.wav { background-position: -550px 0 !important; }
		.mp4 { background-position: -600px 0 !important; }
		.mov, .aiff, .m2v, .avi, .pict, .qif { background-position: -650px 0 !important; }
		.wmv, .avi, .mpg { background-position: -700px 0 !important; }
		.flv, .f2v { background-position: -750px 0 !important; }
		.psd { background-position: -800px 0 !important; }
		.ai { background-position: -850px 0 !important; }
		.html, .xhtml, .dhtml, .php, .asp, .css, .js, .inc { background-position: -900px 0 !important; }
		.dir { background-position: -950px 0 !important; }
		
		.sub { margin-left: 20px; border-left: solid 5px #ECE9E9; display: none; }
		
		body.dark { background: #1d1c1c; color: #fff; }
		body.dark h1 { color: #fff; }
		body.dark .wrap { background: #2b2a2a; }
		body.dark .block { border-top: solid 1px #666; }
		body.dark .block a:hover, body.dark .block a.open { background: #000; }
		body.dark .note { color: #fff; }
		body.dark .block .data { color: #fff; }
		body.dark .sub { border-left: solid 5px #0e0e0e; }
	</style>
</head>
<body class="<?php echo $color; ?>">

<?php
// PASSWORD CHECK AND LOGIN SECTION
session_start();

// Check if password has been submitted and if hashed password is not null
if (isset($_POST['password']) && $hashed_password !== '') {
  // Validate password
  if (password_verify($_POST['password'], $hashed_password)) {
    // If validation passes, set session variable
    $_SESSION['authenticated'] = true;
  } else {
    // If validation fails, set error message
    $error_message = "Invalid password!";
  }
}

// Check if user is authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
  // If user is not authenticated, display login form
  if (isset($error_message)) {
    echo "<p style='color:red;'>{$error_message}</p>";
  }
  // Display password field only if hashed password is not null (or the variable is setted)
  if ($hashed_password !== '' && isset($hashed_password) !== False) {
	echo "<h1>Login</h1>";
    echo "<form method='post'>";
    echo "<label for='password'>Password:</label><br>";
    echo "<input type='password' id='password' name='password'><br><br>";
    echo "<input type='submit' value='Login'>";
    echo "</form>";
	exit;
  }
  
} else {
  // If user is authenticated, display the contents of the folder
  	echo "<form method='post'>";
  	echo "<input type='hidden' name='logout' value='destroy_session'>";
  	echo "<button type='submit'>Logout</button>";
	echo "</form>";
	if (isset($_POST["logout"])) {
		session_destroy();
		header("Location: index.php");
		exit;
	  }
  }
?>

<h1><?php echo $title ?></h1>
<div class="wrap">
<?php

// FUNCTIONS TO MAKE THE MAGIC HAPPEN, BEST TO LEAVE THESE ALONE
function clean_title($title)
{
	return ucwords( str_replace( array("-", "_"), " ", $title) );
}

function ext($filename) 
{
	return substr( strrchr( $filename,'.' ),1 );
}

function display_size($bytes, $precision = 2) 
{
	$units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 
    $bytes /= (1 << (10 * $pow)); 
	return round($bytes, $precision) . '<span class="fs-0-8 bold">' . $units[$pow] . "</span>";
}

function count_dir_files( $dir)
{
	$fi = new FilesystemIterator(__DIR__ . "/" . $dir, FilesystemIterator::SKIP_DOTS);
	return iterator_count($fi);
}

function get_directory_size($path)
{
    $bytestotal = 0;
    $path = realpath($path);
    if($path!==false && $path!='' && file_exists($path))
    {
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object)
        {
            $bytestotal += $object->getSize();
        }
    }
    
    return display_size($bytestotal);
}


// SHOW THE MEDIA BLOCK
function display_block( $file )
{
	global $ignore_file_list, $ignore_ext_list, $force_download;
	
	$file_ext = ext($file);
	if( !$file_ext AND is_dir($file)) $file_ext = "dir";
	if(in_array($file, $ignore_file_list)) return;
	if(in_array($file_ext, $ignore_ext_list)) return;
	
	$download_att = ($force_download AND $file_ext != "dir" ) ? " download='" . basename($file) . "'" : "";
	
	$rtn = "<div class=\"block\">";
	$rtn .= "<a href=\"$file\" class=\"$file_ext\"{$download_att}>";
	$rtn .= "	<div class=\"img $file_ext\"></div>";
	$rtn .= "	<div class=\"name\">";
	
	if ($file_ext === "dir") 
	{
		$rtn .= "		<div class=\"file fs-1-2 bold\">" . basename($file) . "</div>";
		$rtn .= "		<div class=\"data upper size fs-0-7\"><span class=\"bold\">" . count_dir_files($file) . "</span> files</div>";
		$rtn .= "		<div class=\"data upper size fs-0-7\"><span class=\"bold\">Size:</span> " . get_directory_size($file) . "</div>";
		
	}
	else
	{
		$rtn .= "		<div class=\"file fs-1-2 bold\">" . basename($file) . "</div>";
		$rtn .= "		<div class=\"data upper size fs-0-7\"><span class=\"bold\">Size:</span> " . display_size(filesize($file)) . "</div>";
		$rtn .= "		<div class=\"data upper modified fs-0-7\"><span class=\"bold\">Last modified:</span> " .  date("D. F jS, Y - h:ia", filemtime($file)) . "</div>";	
	}

	$rtn .= "	</div>";
	$rtn .= "	</a>";
	$rtn .= "</div>";
	return $rtn;
}


// RECURSIVE FUNCTION TO BUILD THE BLOCKS
function build_blocks( $items, $folder )
{
	global $ignore_file_list, $ignore_ext_list, $sort_by, $toggle_sub_folders, $ignore_empty_folders;
	
	$objects = array();
	$objects['directories'] = array();
	$objects['files'] = array();
	
	foreach($items as $c => $item)
	{
		if( $item == ".." OR $item == ".") continue;
	
		// IGNORE FILE
		if(in_array($item, $ignore_file_list)) { continue; }
	
		if( $folder && $item )
		{
			$item = "$folder/$item";
		}

		$file_ext = ext($item);
		
		// IGNORE EXT
		if(in_array($file_ext, $ignore_ext_list)) { continue; }
		
		// DIRECTORIES
		if( is_dir($item) ) 
		{
			$objects['directories'][] = $item; 
			continue;
		}
		
		// FILE DATE
		$file_time = date("U", filemtime($item));
		
		// FILES
		if( $item )
		{
			$objects['files'][$file_time . "-" . $item] = $item;
		}
	}
	
	foreach($objects['directories'] as $c => $file)
	{
		$sub_items = (array) scandir( $file );
		
		if( $ignore_empty_folders )
		{
			$has_sub_items = false;
			foreach( $sub_items as $sub_item )
			{
				$sub_fileExt = ext( $sub_item );
				if( $sub_item == ".." OR $sub_item == ".") continue;
				if(in_array($sub_item, $ignore_file_list)) continue;
				if(in_array($sub_fileExt, $ignore_ext_list)) continue;
			
				$has_sub_items = true;
				break;	
			}
			
			if( $has_sub_items ) echo display_block( $file );
		}
		else
		{
			echo display_block( $file );
		}
		
		if( $toggle_sub_folders )
		{
			if( $sub_items )
			{
				echo "<div class='sub' data-folder=\"$file\">";
				build_blocks( $sub_items, $file );
				echo "</div>";
			}
		}
	}
	
	// SORT BEFORE LOOP
	if( $sort_by == "date_asc" ) { ksort($objects['files']); }
	elseif( $sort_by == "date_desc" ) { krsort($objects['files']); }
	elseif( $sort_by == "name_asc" ) { natsort($objects['files']); }
	elseif( $sort_by == "name_desc" ) { arsort($objects['files']); }
	
	foreach($objects['files'] as $t => $file)
	{
		$fileExt = ext($file);
		if(in_array($file, $ignore_file_list)) { continue; }
		if(in_array($fileExt, $ignore_ext_list)) { continue; }
		echo display_block( $file );
	}
}

// GET THE BLOCKS STARTED, FALSE TO INDICATE MAIN FOLDER
$items = scandir( dirname(__FILE__) );
build_blocks( $items, false );
?>

<?php if($toggle_sub_folders) { ?>
<script type="text/javascript">
	$(document).ready(function() 
	{
		$("a.dir").click(function(e)
		{
			$(this).toggleClass('open');
		 	$('.sub[data-folder="' + $(this).attr('href') + '"]').slideToggle();
			e.preventDefault();
		});
	});
</script>
<?php } ?>
</div>
<div style="padding: 10px 10px 40px 10px;"><a href="https://halgatewood.com/free/file-directory-list/">Free PHP File Directory Script</a> (<a href="https://github.com/halgatewood/file-directory-list/">GitHub</a>)</div>
</body>
</html>
