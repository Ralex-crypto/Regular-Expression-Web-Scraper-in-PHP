<?php
      if($argc > 1){
	  $filename = $argv[1];
	  $file_check = file_exists($filename);
	  if($file_check == false){
	      echo "File not found. Terminating.\n";
	      exit(-1);
	  }

	  echo "File read successfully.\n";
      }
      else{
	  echo "Please include html file in argument.\n";
	  exit(-1);
      }

      $file_content = file_get_contents($filename);

      preg_match('/~(.*)"/', $file_content, $matches);
      $url = str_replace('"', '', $matches[0]);
      #echo $url . "\n";

      preg_match('~\. (.*)_files/css~', $file_content, $matches);
      $name = str_replace('. ', '', $matches[0]);
      $name = str_replace('_files/css', '', $name);
      #echo $name . "\n";                       
      
      preg_match('~Education(.*?)</p></div>~s', $file_content, $matches);
      $education = str_replace('Education</h3>
                </div>
                <div class="panel-body"><p>', '', $matches[0]);
      $education = str_replace('</p></div>', '', $education);
      #echo $education . "\n";

      preg_match('~Research Interests(.*?)</p></div>~s', $file_content, $matches);
      $research = str_replace('Research Interests</h3>
                </div>
                <div class="panel-body"><p>', '', $matches[0]);
      $research = str_replace('</p></div>', '', $research);      
      #echo $research . "\n";

      preg_match('~Office Location(.*?)</p>~s', $file_content, $matches);
      $office = str_replace('Office Location</h3>
                </div>
                <div class="panel-body">
                    
                    <p>', '', $matches[0]);
      $office = str_replace('</p>', '', $office);
      #echo $office . "\n";

      $ofile = fopen("output.txt", "w");

      $txt = "Name: ";
      fwrite($ofile, $txt);
      fwrite($ofile, $name);
      $txt = "\nEducation: ";
      fwrite($ofile, $txt);
      fwrite($ofile, $education);
      $txt = "\nResearch Interests: ";
      fwrite($ofile, $txt);
      fwrite($ofile, $research);
      $txt = "\nOffice: ";
      fwrite($ofile, $txt);
      fwrite($ofile, $office);
      $txt = "\nWebpage: http://cs.txstate.edu/";
      fwrite($ofile, $txt);
      fwrite($ofile, $url);
      fwrite($ofile, "\n");

      fclose($ofile);            
?>


