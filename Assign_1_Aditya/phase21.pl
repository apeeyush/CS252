#!/usr/bin/perl

open(IN, "phase1.out");
@lines = <IN>;
close(IN);

#create table
$query = "Create table marks(roll integer(6),course integer(2),assignment integer(3),project integer(3),exam integer(3),primary key (roll,course));";
perform($query);
$num = scalar @lines;
@rolls = [];

for( $i=0; $i<$num ;$i=$i+1)
{
	$line = @lines[$i];
	@vals = split(',',$line);
	$roll=@vals[0];
	@cr=(@vals[1],@vals[2],@vals[3]);
	push ( @rolls, int($roll) );
	for( $j=0; $j<=2 ;$j=$j+1)
	{
		$query = "Insert into marks values(";
		$query=$query.$roll.",";
		$query=$query.@cr[$j].",";
		$po = 3*$j + 4;
		$query=$query.@vals[$po].",";
		$query=$query.@vals[$po+1].",";
		$query=$query.@vals[$po+2];
		$query=$query.");";
		perform($query);
	}
}
$query = "Create table names(roll integer(6),name varchar(30),primary key (roll));";
perform($query);

open(IN, "names.txt");
@names = <IN>;
close(IN);

@rolls = sort { $a <=> $b } @rolls;

for( $i=0; $i<$num ;$i=$i+1)
{
chomp(@names[$i]);
$query = "Insert into names values(\'@rolls[$i]\',\'@names[$i]\');";
perform($query)
}

sub perform
{
	$query=shift(@_);
	#perform the given query
	$execute = "echo \"". $query . "\" | mysql -u root test";
	system($execute);
}