
<?php extract ( $_POST ) ;

#echo $USERNAME;
#echo $PASSWORD;
// check if user has left USERNAME or PASSWORD field blank
if ( !$USERNAME || !$PASSWORD ) {
    fieldsBlank();
	die();
}

#echo $file = fopen("password.txt", "r");
if(!($file = fopen("password.txt", "r"))){
    print("Could not open password file");
    die();
}

$userVerified=0;
while(!feof($file) && !$userVerified){
    $line = fgets($file, 255);
	#echo "Line";
	#echo $line;
    $line = chop($line);
	
	#echo "Line 2";
	#echo $line;
    $field = explode(",", $line,2);
	
	#echo "field0";
	#echo  $field[0];
	#echo "field1";
	#echo  $field[1];
    if($USERNAME == $field[0]){
        $userVerified = 1;
        if(checkPassword($PASSWORD, $field) == true)
            accessGranted();
        else{
            wrongPassword();
        }
    }
}
fclose($file);

if(!$userVerified){
    accessDenied();
}
function checkPassword($userpassword, $filedata){
    if($userpassword == $filedata[1]){
        return true;
    }
    else{
        return false;
    }
}
function accessGranted(){
    include 'list.php';
    #readfile("list.html");
}
function wrongPassword(){
    print("You entered an invalid password");
}

function accessDenied(){
	print("Access denied");
}

function fieldsBlank (){
    print("Fields Blank");
}

?>