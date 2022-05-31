<?php
$word = new COM("Word.Application");
$word->Visible = true;
$word->Documents->Add();
$word->Selection->TypeText("Name: Danilo Zdravkovic\n
                            Date of birth: July 8th, 1997\n
                            Email: danilo.zdravkovic.227.16@ict.edu.rs\n
                            Study Programme: Internet Technologies\n
                            For any questions you can @ me at: danilo.zdravkovic.227.16@ict.edu.rs");
$word->Documents[1]->SaveAs("aboutExported.doc");