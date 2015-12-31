<!DOCTYPE html>
<html>
<title>El 3M'S w nourhan</title>
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />
     <script type="text/javascript">

function validate()
{

var pass= document.getElementById("password").value;
var pass1= document.getElementById("repassword").value;

if(pass != pass1)
{
alert ("passwords are not matching !");
return false;
}

var email = document.getElementById("email").value;
var regex = /^([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)@([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)[\\.]([a-zA-Z]{2,9})$/;
if(!regex.test(email)){
 alert("Enter a valid email");
 return false;
     }
var fname= document.getElementById("fname").value;
var lname= document.getElementById("lname").value;
var letters = /^[A-Za-z]+$/;
if(!fname.match(letters))  
      
     {  
     alert("your first name must be letters only");  
     return false;  
     } 
if(!(lname.match(letters)))  
      
     {  
     alert("your last name must be letters only");  
     return false;  
     } 
   

return true;

} 
</script>
</head>
<body>
<div class="container">
 <div class="back-to-reg">
                <a href="Profile.php" target = "_self"><strong>Back To My Profile</strong></a>
                </span>  
                <div class="clr"></div>
            
            </div>
<header>
    <h1><span>Welcome</span>Please Edit required info here:</h1>
            </header>       
      <div  class="form" >
      <form id="contactform" action="edit1.php" method="POST" onsubmit="return validate()"> 
         <p class="contact"><label for="name">First Name</label></p> 
          <input id="fname" name="fname" placeholder="First name" maxlength="14"  tabindex="1" type="text">  

          <p class="contact"><label for="name">Last Name</label></p> 
          <input id="lname" name="lname" placeholder="Last name" maxlength="14" tabindex="2" type="text">   
                <p class="contact"><label for="Phone">Phone number</label></p> 
       <input id="phone" name="phone" placeholder="phone" maxlength="11" tabindex="3" type="text" type="text" pattern="\d{11}" title="11 digits numbers"> 

          <p class="contact"><label for="hometown">Hometown</label></p> 
       <input id="hometown" name="hometown" placeholder="Hometown" tabindex="4" type="text" tabindex="7">
        
               <fieldset>
                 <label>Birthday</label>
                  <label class="month"> 
                  <select class="select-style" name="BirthMonth" tabindex="8">
                  <option value="">Month</option>
                  <option value="01">January</option>
                  <option value="02">February</option>
                  <option value="03" >March</option>
                  <option value="04">April</option>
                  <option value="05">May</option>
                  <option value="06">June</option>
                  <option value="07">July</option>
                  <option value="08">August</option>
                  <option value="09">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12" >December</option>
                  </label>
                 </select>    
               <label>Day<input class="birthday" id="day"  maxlength="2"  type="number" min="1" max="31" name="BirthDay" placeholder="Day" tabindex="9"></label>
                <label>Year <input class="birthyear" maxlength="4" type="number" min="1930" max="2015" name="BirthYear"  placeholder="Year" tabindex="10" ></label>
              </fieldset>
  
            <select class="select-style gender" name="gender" tabindex="11">
            <option value="" >i am..</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            </select><br><br>

             <select class="select-style gender" name="marital" tabindex="12">
            <option value="" >Marital Status</option>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Engaged">Engaged</option>

            </select><br><br>
            
            <p class="contact"><label for="me">About Me:</label></p> 
            <input id="me" name="me" placeholder="Write About Yourself A little" type="text"> <br>
            <input class="buttom" name="submit" id="submit" tabindex="13" value="Edit Info!" type="submit">   
   </form> 
</div>      
</div>
</body>
</html>