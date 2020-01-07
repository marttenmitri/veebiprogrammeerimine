<?php
  $pageHeaderHTML = "<!DOCTYPE html> \n";
  $pageHeaderHTML .= '<html lang="et">'. "\n";
  $pageHeaderHTML .= "<head> \n";
  $pageHeaderHTML .=  "\t" .'<meta charset="utf-8">' ."\n \t<title>" .$userName ."progeb veebi</title> \n";
  $pageHeaderHTML .= "\t" ."<style> \n";
  $pageHeaderHTML .= "\t \t body{background-color: " .$_SESSION["bgColor"] ."; \n";
  $pageHeaderHTML .= "\t \t color: " .$_SESSION["txtColor"] ."\n";
  $pageHeaderHTML .= "\t }";
  $pageHeaderHTML .= "</style> \n";
  if(isset($toScript)){
	  $pageHeaderHTML .= $toScript;
  }
  $pageHeaderHTML .= "</head> \n";
  $pageHeaderHTML .= "<body><img src='../pic100x100/".$_SESSION["picture"]."' alt=".$_SESSION["picture"]." >";
  echo $pageHeaderHTML;