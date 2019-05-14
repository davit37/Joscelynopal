<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<div style="width: 680px;"><a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $store_name; ?>" style="margin-bottom: 20px; border: none;" /></a>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_greeting; ?></p>
  
  <table style="border-collapse: collapse; width: 100%; border: 1px solid #DDDDDD; margin-bottom: 20px;">
    
    <tbody>
        <tr>
            <td>Name</td>
            <td> : <?php echo $name ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td> : <?php echo $email ?></td>
        </tr>
        <tr>
            <td>Comment</td>
            <td> : <?php echo $comment ?></td>
        </tr>
    </tbody>
    
  </table>
  
  
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $store_name; ?> &copy; <?php echo date("Y"); ?> All Rights Reserved</p>
</div>
</body>
</html>
