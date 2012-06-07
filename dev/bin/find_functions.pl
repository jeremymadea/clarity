#!/usr/bin/perl 
#
use Data::Dumper;

die unless -f $ARGV[0] and -r _;

my %functions;

# Pass number one: determine function names. 
open my $source, '<', $ARGV[0] or die $!;

while (<$source>) {
    if ( /function\s*(\w+)\s*\(.*\)/ ) {
	    $functions{$1} = []; 
	}
}

# Pass number two: record where we find it.
open my $source, '<', $ARGV[0] or die $!;
#seek($source, 0, 0); 

while (<$source>) {
    if ( /(\w+)\s*\(/ and exists $functions{ $1 } ) { 
	    push @{ $functions{ $1 } }, $.; 
	}
}

print Dumper( \%functions );
