drop table preferences;
drop table allocations;
drop table units;
drop table users;

create table users(
USERID varchar2(10) NOT NULL,
USERNAME varchar2(20) NOT NULL,
PASSWORD varchar2(20) NOT NULL,
FULLNAME varchar2(50),
EMAIL varchar2(50),
PHONE varchar2(15),
ROLE varchar2(30),
STATUS varchar2(20),
Primary key (USERID)
);

create table units(
UNITCODE varchar2(10) NOT NULL,
UNITNAME varchar2(50) NOT NULL,
DETAILS varchar2(100),
Primary key (UNITCODE)
);

create table allocations(
ALLOCID varchar2(10) NOT NULL,
ALLOCDATE date,
USERID varchar2(10) NOT NULL,
STATUS varchar2(15),
Primary key (ALLOCID),
Foreign key (USERID) references users
);
create table preferences(
ALLOCID varchar2(10) NOT NULL,
USERID varchar2(10) NOT NULL,
UNITCODE varchar2(20) NOT NULL,
PREFERENCE varchar2(20),
CONFLICTS varchar2(50),
APPROVED varchar2(15),
Foreign key (ALLOCID) references allocations,
Foreign key (USERID) references users,
Foreign key (UNITCODE) references units
);




INSERT INTO users VALUES ('1001','fred','123','Fred Smith','not@telling.org','0404040404','Teacher','enabled');
INSERT INTO users VALUES ('1002','sally','123','Sally Smith','not@telling.org','0404040404','Teacher','enabled');
INSERT INTO users VALUES ('1003','john','123','John Doe','not@telling.org','0404040404','Teacher','enabled');
INSERT INTO users VALUES ('1004','marge','123','Margaret Doe','not@telling.org','0404040404','Teacher','enabled');
INSERT INTO users VALUES ('1005','geoff','123','Geoffrey Plod','not@telling.org','0404040404','Teacher','enabled');
INSERT INTO users VALUES ('1006','jaz','123','Jasmine Plod','not@telling.org','0404040404','Head of Institute','enabled');
INSERT INTO users VALUES ('1007','greg','123','Gregory Pierce','not@telling.org','0404040404','Head of Institute','enabled');
INSERT INTO users VALUES ('1008','meg','123','Megan Pierce','not@telling.org','0404040404','Teaching Administrator','enabled');
INSERT INTO users VALUES ('1009','neil','123','Neilan Parker','not@telling.org','0404040404','Teaching Administrator','enabled');
INSERT INTO users VALUES ('1010','penny','123','Penelope Parker','not@telling.org','0404040404','System Administrator','enabled');

INSERT INTO units VALUES ('SIT101','Introduction to IT','1 x 1 hour lecture per week, 1 x 2 hour practical per week');
INSERT INTO units VALUES ('SIT102','Introduction to Programming','1 x 1 hour lecture per week, 1 x 2 hour practical per week');
INSERT INTO units VALUES ('SIT202','Computer Networking','1 x 1 hour lecture per week, 1 x 2 hour practical per week');
INSERT INTO units VALUES ('SIT232','Object Oriented Programming','1 x 1 hour lecture per week, 1 x 2 hour practical per week');
INSERT INTO units VALUES ('SIT313','Mobile Computing','1 x 1 hour lecture per week, 1 x 2 hour practical per week');
INSERT INTO units VALUES ('SIT321','Software Engineering','1 x 1 hour lecture per week, 1 x 2 hour practical per week');
INSERT INTO units VALUES ('SIT322','Distributed Systems','1 x 1 hour lecture per week, 1 x 2 hour practical per week');
INSERT INTO units VALUES ('SIT323','Practical Software Development','1 x 1 hour lecture per week, 1 x 2 hour practical per week');
INSERT INTO units VALUES ('SIT302','Project','1 x 1 hour lecture per week, 1 x 2 hour practical per week');
INSERT INTO units VALUES ('SIT263','Interface Design','1 x 1 hour lecture per week, 1 x 2 hour practical per week');
INSERT INTO units VALUES ('SIT222','Operating Systems','1 x 1 hour lecture per week, 1 x 2 hour practical per week');

INSERT INTO allocations VALUES ('10','12-may-13','1001','waiting');
INSERT INTO allocations VALUES ('20','12-may-13','1001','waiting');
INSERT INTO allocations VALUES ('30','12-may-13','1001','waiting');

INSERT INTO preferences VALUES ('10','1001','SIT101','preferred','NO','NO');
INSERT INTO preferences VALUES ('10','1001','SIT102','nonpreferred','NO','NO');
INSERT INTO preferences VALUES ('10','1001','SIT202','interested','NO','NO');
INSERT INTO preferences VALUES ('10','1001','SIT313','interested','NO','NO');
INSERT INTO preferences VALUES ('20','1002','SIT263','notapplicable','NO','NO');
INSERT INTO preferences VALUES ('20','1002','SIT222','preferred','NO','NO');
INSERT INTO preferences VALUES ('20','1002','SIT302','preferred','NO','NO');
INSERT INTO preferences VALUES ('20','1002','SIT322','preferred','NO','NO');
INSERT INTO preferences VALUES ('30','1003','SIT323','preferred','NO','NO');
INSERT INTO preferences VALUES ('30','1003','SIT321','preferred','NO','NO');


