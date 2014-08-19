#!/bin/bash

mysql -u root test -e "select marks.course,marks.roll,marks.total,names.name from marks inner join names on marks.roll=names.roll INTO OUTFILE '/tmp/temp7.out' fields terminated by ','"

sort -t\, -k 1,1n -k 3,3nr /tmp/temp7.out >temp7.out

rank=0
prev=0
ptot=0
count=1

while read line
do
	course=`echo "$line" | cut -d, -f1`
	roll=`echo "$line" | cut -d, -f2`
	name=`echo "$line" | cut -d\, -f4`
	total=`echo "$line" | cut -d, -f3`
	if [[ $prev -eq  $course ]]
		then
		if [[ $ptot -ne $total ]]
			then
			rank=$((rank+count))
			printf "%s %s\n" $rank $count
			count=1
			ptot=`echo $total`
		else
			let "count++"
		fi
		out=""
		printf -v out "%s\t%s\t%s\t%s\t%s\n" $course $roll $name $rank $total
		echo $out >>phase7.out
	else
		rank=1
		out=""
		ptot=`echo $total`
		count=1
		prev=`echo $course`
		printf -v out "%s\t%s\t%s\t%s\t%s\n" $course $roll $name $rank $total
		echo $out >>phase7.out
	fi
done <temp7.out

rm /tmp/temp7.out