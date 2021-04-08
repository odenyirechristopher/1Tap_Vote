CREATE TABLE news
(
  event_id INT(11) NOT NULL AUTO_INCREMENT,
  event VARCHAR(75) NOT NULL,
  date DATE NOT NULL,
  venue VARCHAR(75) NOT NULL,
  PRIMARY KEY (event_id)
);

CREATE TABLE school
(
  school_id INT(11) NOT NULL AUTO_INCREMENT,
  school_name VARCHAR(75) NOT NULL,
  PRIMARY KEY (school_id)
);

CREATE TABLE course
(
  course_id INT(11) NOT NULL AUTO_INCREMENT,
  course_name VARCHAR(75) NOT NULL,
  school_id INT NOT NULL,
  PRIMARY KEY (course_id),
  FOREIGN KEY (school_id) REFERENCES school(school_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Voter
(
  voter_id INT(11) NOT NULL AUTO_INCREMENT,
  lastname VARCHAR(100) NOT NULL,
  firstname VARCHAR(100) NOT NULL,
  surname VARCHAR(100) NOT NULL,
  gender VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(100) DEFAULT NULL,
  photo VARCHAR(100) DEFAULT NULL,
  exp_date DATE DEFAULT NULL,
  reset_link_token VARCHAR(200) DEFAULT NULL,
  course_id INT NOT NULL,
  PRIMARY KEY (voter_id),
  FOREIGN KEY (course_id) REFERENCES course(course_id)
);

CREATE TABLE docket
(
  docket_id INT(11) NOT NULL AUTO_INCREMENT,
  docket_name VARCHAR(100) NOT NULL,
  is_global enum('1','0') DEFAULT '1',
  created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (docket_id)
);

CREATE TABLE admin
(
  admin_id INT NOT NULL,
  firstname VARCHAR(100) NOT NULL,
  lastname VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  is_active enum('1','0') DEFAULT '1',
  created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  photo VARCHAR(100) DEFAULT NULL,
  reset_link_token VARCHAR(200) DEFAULT NULL,
  exp_date DATE DEFAULT NULL,
  PRIMARY KEY (admin_id)
);

CREATE TABLE candidate
(
  candidate_id INT(11) NOT NULL AUTO_INCREMENT,
  status enum('0','1','2') DEFAULT '0',
  docket_id INT NOT NULL,
  voter_id INT NOT NULL,
  PRIMARY KEY (candidate_id),
  FOREIGN KEY (docket_id) REFERENCES docket(docket_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (voter_id) REFERENCES Voter(voter_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE vote
(
  vote_id INT(50) NOT NULL AUTO_INCREMENT,
  vote_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  voter_id INT NOT NULL,
  candidate_id INT NOT NULL,
  PRIMARY KEY (vote_id),
  FOREIGN KEY (voter_id) REFERENCES Voter(voter_id),
  FOREIGN KEY (candidate_id) REFERENCES candidate(candidate_id)
);