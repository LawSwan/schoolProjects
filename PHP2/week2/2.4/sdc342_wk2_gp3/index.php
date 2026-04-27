<?php
require_once('display_name.php');
require_once('greetings.php');

//replace with your name and names of your choosing
$myName = new DisplayName("Amber", "Lawson");
$friendOne = new DisplayName("Jade", "Green");
$friendTwo = new DisplayName("Violet", "Johnson");
$friendThree = new DisplayName("Tom", "Brown");
?>

<html>
<head>
 <title>Week2 GP3 - Amber Lawson</title>
 <style>
  body {
   margin: 0;
   padding: 0;
   height: 100vh;
   display: flex;
   flex-direction: column;
   justify-content: center;
   align-items: center;
   font-family: Arial, sans-serif;
   background: linear-gradient(45deg, #2E86AB, #A23B72, #F18F01, #C73E1D);
   background-size: 400% 400%;
   animation: gradientShift 8s ease-in-out infinite;
   color: white;
   text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
  }
  
  @keyframes gradientShift {
   0% { background-position: 0% 50%; }
   25% { background-position: 100% 50%; }
   50% { background-position: 100% 100%; }
   75% { background-position: 0% 100%; }
   100% { background-position: 0% 50%; }
  }
  
  h2 {
   font-size: 2.5em;
   margin-bottom: 30px;
   text-align: center;
  }
  
  ul {
   list-style: none;
   padding: 0;
   text-align: center;
  }
  
  li {
   font-size: 1.5em;
   margin: 15px 0;
   padding: 10px 20px;
   background: rgba(255,255,255,0.1);
   border-radius: 10px;
   backdrop-filter: blur(5px);
   border: 1px solid rgba(255,255,255,0.2);
  }
 </style>
</head>
<body>
 <h2>
 <?php echo Greetings::myName() . $myName->getFullName(); ?>
 </h2>
 <ul>
 <li>
 <?php echo Greetings::friend("first") . $friendOne->getFullName(); ?>
 </li>
 <li>
 <?php echo Greetings::friend("second") . $friendTwo->getFullName(); ?>
 </li>
 <li>
 <?php echo Greetings::friend("third") . $friendThree->getFullName(); ?>
 </li>
 </ul>
</body>
</html>
