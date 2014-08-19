roll = (12000 + randperm(833,100))';
courses = zeros(100,3);
for i=1:100
	courses(i,:) = randperm(9,3)';
endfor
marks = ceil(51*rand(100,9))-1;
class = [roll courses marks ];
csvwrite('phase1.out',class);
