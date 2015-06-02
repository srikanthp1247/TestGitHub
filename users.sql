CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Sample Data
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `address`) VALUES
(1, 'lucentx', 'Aron', 'Barbosa', 'Manila, Philippines'),
(2, 'ozzy', 'Ozzy', 'Osbourne', 'England'),
(3, 'tony', 'Tony', 'Iommi', 'England');


CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) ,
  `gender` varchar(25) ,
  `password` varchar(25),
 
  PRIMARY KEY (`uid`)
)

CREATE TABLE table_question
(
qid int(10) NOT NULL AUTO_INCREMENT,
category varchar(25),
title varchar(25),  
question text(1000),
uid int,
PRIMARY KEY (qid),
FOREIGN KEY (uid) REFERENCES user(uid)
)


CREATE TABLE table_answer
(
aid int(10) NOT NULL AUTO_INCREMENT,

solution text(1000),
uid int,
qid int,
PRIMARY KEY (aid),
FOREIGN KEY (uid) REFERENCES user(uid),
    FOREIGN KEY (qid) REFERENCES table_question(qid)
)


UPDATE technical SET category='java' where id ='4';