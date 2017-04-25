<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Cool-Emerald: Random Password Generator</title>
<meta name="keywords" content="password, generator, random" /> 
<meta name="description" content="random password generator" /> 
<style type="text/css">
hr {color: #b13cdc;}
body {
  font-size: 62.5%;
  color: #b13cdc;
	background-color: #FFF3FF;
	font: 1em 'Courier New';	
	text-align: left;
  }
  input {
  color: #b13cdc;
  border-style:solid;
border-color:#b13cdc;
  }
  div {
  color: #CCCCCC;
	font: 0.7em 'Courier New';	
	text-align: center;
  }
  p {
  color: #b13cdc;
	font: 1.2em 'Courier New';	
	text-align: left;
	
  }
</style>
</head>
<body>

<?php
$len=$_REQUEST["length"];
$low=$_REQUEST["lower"];
$up=$_REQUEST["upper"];
$digit=$_REQUEST["digit"];
$special=$_REQUEST["special"];
$hex=$_REQUEST["hexa"];
if(!isset($len)) $len=8;
if(($len<1) || ($len>32)) $len=8;
//if(!isset($low)) $low=1;
//if(!isset($up)) $up=0;
//if(!isset($digit)) $digit=1;
//if(!isset($special)) $special=0;
//if(!isset($hex)) $hex=0;
echo "
Password should have/include:
<br/>
<br/>
<form name='input' action='rpg.php' method='post'>
Length <input type='text' name='length' value='".$len."' />
<br/>
<br/>
<input type='checkbox' name='lower' value=1 ".($low?"Checked":"")."/>Lower case letters
<br/>
<br/>
<input type='checkbox' name='upper' value=1 ".($up?"Checked":"")."/>Upper case letters
<br/>
<br/>
<input type='checkbox' name='digit' value=1 ".($digit?"Checked":"")."/>Decimal Digits
<br/>
<br/>
<input type='checkbox' name='special' value=1 ".($special?"Checked":"")."/>Special characters
<br/>
<br/>
<input type='checkbox' name='hexa' value=1 ".($hex?"Checked":"")."/>Hexadecimal digits
<br/>
<br/>
<input type='submit' value='Submit' />
</form> 
<br/>
<hr/>
";
$c=0;
if($low) $c|=0x01;
if($up) $c|=0x02;
if($digit) $c|=0x04;
if($special) $c|=0x08;
if($hex) $c|=0x10;


if($c) 
{
  echo "<p>";
  for($j=0;$j<10;$j++) echo "<br/><b> ".pass_gen($len,$c)."</b><br/>";
  echo "</p>";
}
else echo "At least one checkbox must be checked.<br/>";

echo "
<br/>
<hr/> 
<br/><div><a href='http://cool-emerald.blogspot.sg/'>.: Cool Emerald :.</a></div><br/>";

echo "<div>Counter: <script type='text/javascript'>";
	echo "var sc_project=5734589; ";
	echo "var sc_invisible=0; ";
	echo "var sc_partition=61; ";
	echo "var sc_click_stat=1; ";
	echo "var sc_security='57402456'; ";
	echo "var sc_text=1; ";
	echo "</script>";

	echo "<script type='text/javascript'";
	echo "src='http://www.statcounter.com/counter/counter.js'></script><noscript><div";
	echo "class='statcounter'><a title='counter on iweb'";
	echo "href='http://www.statcounter.com/iweb/' target='_blank'><img";
	echo "class='statcounter'";
	echo "src='http://c.statcounter.com/5734589/0/57402456/0/'";
	echo "alt='counter on iweb' ></a></div></noscript></div>";
//-------------------------------------------------------------------
//http://en.wikipedia.org/wiki/Password_generator
function pass_gen($len,$c) {
    $pass = '';
    srand((float) microtime() * 10000000);
    for ($i = 0; $i < $len; $i++) {
        $pass .=  GetRandomChr($c);
    }
    return $pass;
}
//-------------------------------------------------------------------
function GetRandomChr($c)
{
  switch($c)
  {
    case 0x01: $rc=GetC1(26,0x61); break;
    case 0x02: $rc=GetC1(26,0x41); break;
    case 0x03: $rc=GetC2(26,0x41,26,0x61); break;
    case 0x04: $rc=GetC1(10,0x30); break;
    case 0x11:
    case 0x15:
    case 0x05: $rc=GetC2(10,0x30,26,0x61); break;
    case 0x12:
    case 0x16:
    case 0x06: $rc=GetC2(10,0x30,26,0x41); break;
    case 0x13:
    case 0x17:
    case 0x07: $rc=GetC3(10,0x30,26,0x41,26,0x61); break;
    case 0x08: $rc=GetC4(15,0x21,7,0x3A,6,0x5B,4,0x7B); break;
    case 0x09: $rc=GetC3(15,0x21,7,0x3A,6+26+4,0x5B); break;
    case 0x0A: $rc=GetC3(15,0x21,7+26+6,0x3A,4,0x7B); break;
    case 0x0B: $rc=GetC2(15,0x21,7+26+6+26+4,0x3A); break;
    case 0x0C: $rc=GetC3(15+10+7,0x21,6,0x5B,4,0x7B); break;
    case 0x19:
    case 0x1D:
    case 0x0D: $rc=GetC2(15+10+7,0x21,6+26+4,0x5B); break;
    case 0x1A:
    case 0x1E:
    case 0x0E: $rc=GetC2(15+10+7+26+6,0x21,4,0x7B); break;
    case 0x1B:
    case 0x1F:
    case 0x0F: $rc=GetC1(15+10+7+26+6+26+4,0x21); break;
    case 0x14:
    case 0x10: $rc=GetC2(10,0x30,6,0x41); break;
    case 0x1C:
    case 0x18: $rc=GetC3(15+10+7+6,0x21,6,0x5B,4,0x7B); break;
    default: break;
  }
  
  if($rc=='<') $rc="&lt;";
  else if($rc=='>') $rc="&gt;";
  else if($rc==chr(34)) $rc="&#34;";
  else if($rc==chr(39)) $rc="&#39;";
  else if($rc==chr(38)) $rc="&amp;";
  
  return $rc;
}
//-------------------------------------------------------------------
function GetC1($n,$l)
{
     $ac= rand(0, $n-1)+$l;
     return chr($ac);
}
//-------------------------------------------------------------------
function GetC2($n1,$l1,$n2,$l2)
{
      $ac= rand(0, $n1+$n2-1);
      if($ac<$n1) $ac+=$l1;
      else $ac+=$l2-$n1;
      return chr($ac);
}
//-------------------------------------------------------------------
function GetC3($n1,$l1,$n2,$l2,$n3,$l3)
{
      $ac= rand(0, $n1+$n2+$n3-1);
      if($ac<$n1) $ac+=$l1;
      else if($ac<($n1+$n2)) $ac+=$l2-$n1;
      else $ac+=$l3-$n1-$n2;
      return chr($ac);
}
//-------------------------------------------------------------------
function GetC4($n1,$l1,$n2,$l2,$n3,$l3,$n4,$l4)
{
      $ac= rand(0, $n1+$n2+$n3+$n4-1);
      if($ac<$n1) $ac+=$l1;
      else if($ac<($n1+$n2)) $ac+=$l2-$n1;
      else if($ac<($n1+$n2+$n3)) $ac+=$l3-$n1-$n2;
      else $ac+=$l4-$n1-$n2-$n3;
      return chr($ac);
}
//-------------------------------------------------------------------
?>
</body>
</html>
