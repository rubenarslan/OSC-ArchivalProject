Archival Project
================

This is a framework for the [COS](http://openscienceframework.org) [Archival Project](http://archivalproject.org), 
which aims to code psychological studies' statistics.

It's written using CakePHP and makes use of jQuery, Twitter Bootstrap, Webshims Lib and Select2.

The code is missing the Config directory, which can be taken from a CakePHP 2.x distribution. 

The code can probably be adapted to other meta-analyses, but it requires some knowledge of PHP and 
JavaScript, jQuery to do so.  
I'm happy to be contacted and assist if you want to use this for noncommercial purposes.

## Current features

* add papers
	* DOI retrieval based on free form references (using labs.crossref.org API)
	* metadata retrieval based on DOI
		* gets metadata via DOI from dx.doi.org API
		* gets abstracts and nr. of citations from pubmed API
* allow users to code studies using a hierarchical, dynamic coding form
	* coding form does some primitive validation, assists in input
	* sub-studies and sub-effect tests can be added
	* autosaves
* users can view and compare different codings of the same paper
* exports wide format data in CSV, TSV, HTML and Excel

# todo:
* todo: max 4 coders per paper? maybe in the future, not now
* todo: drag and drop study order