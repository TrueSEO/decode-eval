<?php
// Why
/*
	Why this project was even started...  I bought some code from a developer on rentacoder that I bought full rights
	to and he encrypted almost ALL of it so I would be "forced" to use him for future work on the project.  Needless to say
	I wont be using him again expecially since part of the project requirements were full unobfuscated code.  
	
	I found the bulk of this code on the net. I've modified some of it and added instructions
*/

// Use
/*
	Decode a single file  It's best to provide the "Full path" to the file.
	php replace2.php <FILENAME>.PHP  
	
	Linux/OSX
	Decode All Files inside Folder Recursively
	$ find . -type f -name "*.php" -exec php replace2.php \{} \;  
	
	Windows/DOS (Untested) 
	Decode All Files inside Folder Recursively 
	for /r %f in (*.php) do php replace2.php %f
*/

// TODO 
/*
	Usabile output without further editing
	Check if eval is inside of javascript 
*/
echo "\nDECODE nested eval() by DEBO Jurgen  mod by sjc  \n\n";
function is_nested( $text )
{
    return preg_match( "/eval/", $text );
}
function denest( $text )
{
    global $verbose;
    $text = preg_replace( "/<\?php|<\?|\?>/", "", $text );
    if ( $verbose )
        dump( $text, FALSE );
    $text = preg_replace( "/eval/", "\$text=", $text );   
    $t2   = $text;
    $t2   = preg_replace( "/text/", "txt", $t2 );
    $test = eval( $text );
    $text = $t2 . $text;
    if ( $verbose )
        dump( $text, FALSE );
    return $text;
}
echo "Loading Dump";
function dump( $text, $final )
{
    static $counter = 0;
    global $filename_base;
    global $filename_dir;
    global $filename_full;
    $filename_new = ( $final ) ? ( $filename_full ) : ( $filename_dir . '/' . $filename_base . "." . sprintf( "%04d", ++$counter ) . ".php" );
    echo "Writing " . $filename_new . "\n";
    $fp2 = fopen( $filename_new, "w" );
    fwrite( $fp2, trim( $text ) );
    fclose( $fp2 );
}
//Main
echo "Starting...";
    if ( strstr( __FILE__, $filename_full ) == TRUE )
    {
      die('Cannot Decode This File.....');
    }
     $filename_full = $argv[1];
    //$verbose       = (bool) $argv[2];
    $verbose = 0;
    $filename_base = basename( $filename_full, '.php' );
    $filename_dir  = dirname( $filename_full );
    $content       = "";
    echo "Using: " . $filename_base . ".php\n";
    echo "Read...\n";
    $fp1     = fopen( $filename_full, "r" );
    $content = fread( $fp1, filesize( $filename_full ) );
    fclose( $fp1 );
    echo "Decode...\n";
    while ( is_nested( $content ) )
        $content = denest( $content );
    dump( $content, TRUE );
