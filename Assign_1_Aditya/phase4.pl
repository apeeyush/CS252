#!/usr/bin/perl

open(phase3,"phase4.in");
@lines = <phase3>;
close(phase3);

%grd = ();
$grd{"A*"}=0;
$grd{"A"}=1;
$grd{"B"}=2;
$grd{"C"}=3;
$grd{"D"}=4;
$grd{"F"}=5;

$prev=0;
$out="Course\tA*\tA\tB\tC\tD\tF\n";
@grade = (0,0,0,0,0,0);

for($i=1;$i<=$#lines;$i++){
	@curr = split("\t",$lines[$i]);
	$course = $curr[0];
	chomp($curr[2]);
	if($course ne $prev){
		if($prev ne 0){
			$list = join("\t",@grade);
			$out = $out.$prev."\t".$list."\n";
		}
		$prev=$course;
		@grade = (0,0,0,0,0,0);
		$grade[$grd{$curr[1]}]=$curr[2];
	}
	else{
		$grade[$grd{$curr[1]}]=$curr[2];
	}
}

$list = join("\t",@grade);
$out = $out.$prev."\t".$list."\n";

open(out,">phase4.out");
print out $out;
close(out);

exit;
