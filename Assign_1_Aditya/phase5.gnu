set title "Phase 5 histogram"
set auto x
set yrange [0:30]
set style data histogram
set style histogram cluster gap 1
set style fill solid border -1
set boxwidth 0.9
set xtic rotate by -45 scale 0 font ",8"
set ylabel "number of students"
set xlabel "course number"
#set bmargin 10 
set term postscript eps color enhanced "Helvetica" 24
set output	 "phase5.eps"
plot 'phase5.in' using 2:xtic(1)  ti col, \
	'' u 3 ti col, \
	'' u 4 ti col, \
	'' u 5 ti col, \
	'' u 6 ti col,\
	'' u 7 ti col
quit
