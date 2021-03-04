

<html>
   
   <head>
      <title>Email Service</title>
      <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/date_pic/date_input.css">
   </head>
   
   <body>
       <table class="form" border="0" cellspacing="0" cellpadding="0">
       <form action="testmail.php" method="POST">

               <tr>
                   <td>To</td>
                   <td> : </td>
                   <td><input type="text" name="send_to" id="send_to" style="height: 40px; width: 300px; border-color: greenyellow" required></td>
               </tr>
               <tr>
                   <td>Subject</td>
                   <td> : </td>
                   <td><input type="text" name="subject" id="subject" style="height: 40px; width: 300px; border-color: greenyellow" required></td>
               </tr>
               <tr>
                   <td>Message</td>
                   <td> : </td>
                   <td><textarea name="message" id="message" style="height: 100px; width: 300px; border-color: greenyellow" required></textarea></td>
               </tr>
               <tr>
                   <td></td>
                   <td></td>
                   <td><input type="submit" value="submit"></td>
               </tr>
           
       </form>
           </table>
    
      <?php
	  if (isset($_POST['send_to'])){
         $to = $_POST['send_to'];
         $subject = $_POST['subject'];
         
         $message = $_POST['message'];
         //$message .= "<h1>This is headline.</h1>";
         
         $header = "From:dipak@isolutionsbd.net"."\r\n";
         
         //$retval = mail ($to,$subject,$message,$header);
         
         if( mail ($to,$subject,$message,$header) ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
      }
	  /*
      if (isset($_POST['send_to'])){
         $to = $_POST['send_to'];
         $subject = $_POST['subject'];
         
         $message = $_POST['message'];
         //$message .= "<h1>This is headline.</h1>";
         
         $header = "From:dipak@isolutionbd.net \r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
      }*/
      ?> 
   </body>
</html>