<?php
	// get the file extesion of the uploaded document.
	// you can use my upload script to uplaod files (https://github.com/jamesnine/php_upload_script)

	if($fileext === "doc")
		// install "catdoc" program (on debian, just do an apt-get install catdoc)
		$txt_cl = "catdoc " . $sourcefile . " > " . $txtfile;
	else if($fileext === "docx")
		// if you don't want to count footnotes, then remove "word/footnotes.xml"
		$txt_cl = "unzip -p " . $sourcefile . " word/document.xml word/footnotes.xml | sed -e 's/<[^>]\{1,\}>//g; s/[^[:print:]]\{1,\}//g' > " . $txtfile;

	$result = shell_exec($txt_cl);
	$word_count = str_word_count(file_get_contents($txtfile));

	echo $word_count;