decode-eval
===========

Decode php encoded with eval statements.

Why
	Why this project was even started...  I bought some code from a developer on rentacoder that I bought full rights
	to and he encrypted almost ALL of it so I would be "forced" to use him for future work on the project.  Needless to say
	I wont be using him again expecially since part of the project requirements were full unobfuscated code.  
	
	I found the bulk of this code on somewhere on the net. I've modified some of it and added instructions.  Please fork this
	if you have any improvements to make to it.  


Use
	Decode a single file  It's best to provide the "Full path" to the file.
	php replace2.php <FILENAME>.PHP  
	
	Linux/OSX
	Decode All Files inside Folder Recursively
	$ find . -type f -name "*.php" -exec php replace2.php \{} \;  
	
	Windows/DOS (Untested) 
	Decode All Files inside Folder Recursively 
	for /r %f in (*.php) do php replace2.php %f

TODO 
	Usabile output without further editing
	Check if eval is inside of javascript