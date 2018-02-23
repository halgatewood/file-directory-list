# Free Super Clean PHP File Directory Listing Script

Easily display files and folders in a mobile friendly, clean and cool way. Just drop the `index.php` in your folder and you are ready to go.

## Options 

At the top of the `index.php` file you have a few settings you can change:

--
`$title = "List of Files";`

This will be the title of your page and also is set to the meta mitle of the document.

--
`$color	= "light";`
Change this variable to `dark` when you are feeling down.

--
`$ignore_file_list = array( ".htaccess", "Thumbs.db", ".DS_Store", "index.php" );`

Create an array of files that you do not want to appear in the listing

--
`$ignore_ext_list = array( );`

You can create an array of extensions not to show, for example: 'jpg,png,gif,pdf'

--
`$sort_by = "name_asc";`

This will sort the files, the available options are: name_asc, name_desc, date_asc, date_desc

--
`$icon_url = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA+gAAAAyCAYAAADP7vEw....";`

A data sprite of evenly spaced out icons. You can create your own like the one found here: https://www.dropbox.com/s/lzxi5abx2gaj84q/flat.png?dl=0

--
`$toggle_sub_folders = true;`

If a folder is clicked on, it will slide down the sub folder. You can turn this off here.

--
`$force_download = true;`

This will add the html download attribute which forces the download in some browsers.

--
`$ignore_empty_folders = true;`

Ability to hide empty folders.
