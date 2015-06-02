





CREATE TABLE table_Answer
(
aid int NOT NULL,
id int NULL,
qid int,
solution Text(1000),
PRIMARY KEY (aid),
FOREIGN KEY (id) REFERENCES user(id),
FOREIGN KEY (qid) REFERENCES table_Question(qid)
)

