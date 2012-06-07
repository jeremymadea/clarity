#!/bin/sh

DIR=.

/usr/bin/phpdoc -d $DIR/clarity,$DIR/test,$DIR/views -t /var/www/projects/clarity/docs -ti "Clarity Documentation" -dn Clarity -o HTML:Smarty:default -s on 

