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
	//$icon_url = "https://www.dropbox.com/s/lzxi5abx2gaj84q/flat.png?dl=0"; // DIRECT LINK
	$icon_url = "data:image/png;base64,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";
	
	// TOGGLE SUB FOLDERS, SET TO false IF YOU WANT OFF
	$toggle_sub_folders = true;
	
	// FORCE DOWNLOAD ATTRIBUTE
	$force_download = true;
	
	// IGNORE EMPTY FOLDERS
	$ignore_empty_folders = true;

	
// SET TITLE BASED ON FOLDER NAME, IF NOT SET ABOVE
if( !$title ) { $title = clean_title(basename(dirname(__FILE__))); }
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,maximum-scale=1.0, viewport-fit=cover">
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
	if(is_dir($file)) $file_ext = "dir";
	if(in_array($file, $ignore_file_list)) return;
	if(in_array($file_ext, $ignore_ext_list)) return;
	
	$download_att = ($force_download AND $file_ext != "dir" ) ? " download=\"" . htmlEntities(basename($file), ENT_QUOTES) . "\"" : "";
	$file_url = htmlEntities(rawurlencode($file), ENT_QUOTES);

	$rtn = "<div class=\"block\">".PHP_EOL;
	$rtn .= "<a href=\"$file_url\" class=\"$file_ext\"{$download_att}>".PHP_EOL;
	$rtn .= "	<div class=\"img $file_ext\"></div>".PHP_EOL;
	$rtn .= "	<div class=\"name\">".PHP_EOL;
	
	if ($file_ext === "dir") 
	{
		$rtn .= "		<div class=\"file fs-1-2 bold\">" . htmlspecialchars(basename($file), ENT_QUOTES) . "</div>".PHP_EOL;
		$rtn .= "		<div class=\"data upper size fs-0-7\"><span class=\"bold\">" . count_dir_files($file) . "</span> files</div>".PHP_EOL;
		$rtn .= "		<div class=\"data upper size fs-0-7\"><span class=\"bold\">Size:</span> " . get_directory_size($file) . "</div>".PHP_EOL;
	}
	else
	{
		$rtn .= "		<div class=\"file fs-1-2 bold\">" . htmlspecialchars(basename($file), ENT_QUOTES) . "</div>".PHP_EOL;
		$rtn .= "		<div class=\"data upper size fs-0-7\"><span class=\"bold\">Size:</span> " . display_size(filesize($file)) . "</div>".PHP_EOL;
		$rtn .= "		<div class=\"data upper modified fs-0-7\"><span class=\"bold\">Last modified:</span> " .  date("D. F jS, Y - h:ia", filemtime($file)) . "</div>".PHP_EOL;	
	}

	$rtn .= "	</div>".PHP_EOL;
	$rtn .= "	</a>".PHP_EOL;
	$rtn .= "</div>".PHP_EOL;
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
	
		if( $folder !== false )
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
				$file_url = htmlEntities(rawurlencode($file), ENT_QUOTES);
				echo "<div class='sub' data-folder=\"$file_url\">";
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
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
