#!/usr/bin/perl

open(marks,"phase2.in");
@class= <marks>;
close(marks);

open(fl,"names.txt");
@names = <fl>;
close(fl);

$user = "root";
system "mysql -u $user test -e 'create table marks(roll int(5) not null, course int(1) not null, assignment int(2) not null, project int(2) not null, exam int(2) not null, primary key(roll,course));'";
system "mysql -u $user test -e 'create table names(roll int(2) not null primary key, name varchar(25) not null) ' ";

for($i=0;$i <= $#class; $i++){
	@score = split(",", $class[$i]);
	$roll = $score[0];

	for($j=0;$j<3;$j++){
		$l = 3*$j + 4;
		$r = $l + 2;
		$curr = join(",",@score[$l..$r]);
		chomp($curr);
		$str = $roll.",".$score[$j+1].",".$curr;
		system "mysql -u $user test -e 'insert into marks(roll,course,assignment,project,exam) values( $str ); '";
	}

	$temp = $names[$i];
	chomp($temp);
	@name = split(" ",$temp);
	$temp = $name[0];
	$query=$roll.",\"".$temp."\"";
	#print $query."\n";
	system " mysql -u $user test -e ' insert into names(roll,name) values( $query ); ' ";
}
exit;
