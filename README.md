# jointProject

database tables:

table: bookingApp
columns: username(varchar(11)), password(varchar(255)), Appointment Date(date), Appointment Time(time(6)), Vaccination Date(date), Vaccination Time(time(6)), Result(varchar(11)), IV(varchar(32)), Name(varchar(32)), Number(varchar(32)).

table: details
columns: Appointment Number(int(11)), Appointment Date(date), Appointment Time(timestamp(4)), Location(varchar(11)), Status(varchar(11)). 

table: vaccine
columns: Appointment Number(int(11)), Appointment Date(date), Appointment Time(time(4)), Location(varchar(11)), Status(varchar(11)). 
