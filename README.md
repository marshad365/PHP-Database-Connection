# PHP-Database-Connection
It is PHP class that enables the PHP developer to easily connect to database using PDO and execute queires with single function call. All they need to do is to pass the query and the constraints values and the query type and they can get all the results. 
Step#1: 
first of all configure the settings of database connectivity using the $dns variable. You need to provide the hostname/IP address and the database name. after that you need to provide the MySQL database username (default is 'root') and password (default is '').

Step#2: 
Now you can make the class object by including the connection file and you can simple call the member function execute query. It accepts 3 parameters. 
1. $query: (String) e.g: "select * from  something Where id=? and name=? and status=?"
2. $values: (array) e.g: "array(1, 'Arshad', 0)" its an array that is used to pass query values for the place holder(?) used in above example. 
3. $type: (String) e.g it's the type of query whether it is insert query or delete etc. There are 4 possible type
    i.   creat: It is used for create query like inserting something into table.
    ii.  read: It is used to read simple results like "Select * from table1" Here we don't have a where clause or any constraint value.
    iii. cread: It is used to read constraints result like the "select * from  something Where id=? and name=? and status=?"
    iv.  update: It is used to update records. 
    v.   delete: It is used to delete records.

