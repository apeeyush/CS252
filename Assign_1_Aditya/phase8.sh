#!/bin/bash
touch phase1.out
touch phase3.out
touch phase4.out
ln -s phase1.out phase2.in
ln -s phase3.out phase4.in
ln -s phase4.out phase5.in
octave phase1.m
perl phase2.pl
mysql -u root <phase3.sql >phase3,out
perl phase4.pl
gnuplot <phase5.gnu

pdflatex phase6.tex
pdflatex phase6.tex
chmod 744 ./phase7.sh
./phase7.sh