CREATE TABLE Users(
	username VARCHAR(50) PRIMARY KEY NOT NULL,
	name VARCHAR(50) NOT NULL,
	surname VARCHAR(50) NOT NULL,
	email VARCHAR(100) NOT NULL,
	class VARCHAR(30) NOT NULL,
	password VARCHAR(255) NOT NULL
);

CREATE TABLE Matters(
    name VARCHAR(100) NOT NULL,
    sect VARCHAR(50) NOT NULL,
    PRIMARY KEY(name,sect)
);

CREATE TABLE Questions(
    ID_Question INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description MEDIUMTEXT ,
    username VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    sect VARCHAR(50) NOT NULL,
    date_time DATETIME NOT NULL,
    FOREIGN KEY(name,sect) REFERENCES Matters(name,sect),
    FOREIGN KEY(username) REFERENCES Users(username)
);
CREATE TABLE Answers(
    ID_Answer INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    description MEDIUMTEXT NOT NULL,
    correct BOOLEAN NOT NULL,
    ID_Question INTEGER NOT NULL,
    username VARCHAR(50) NOT NULL,
    date_time DATETIME NOT NULL, 
    FOREIGN KEY(ID_Question) REFERENCES Questions(ID_Question) ON DELETE CASCADE,
    FOREIGN KEY(username) REFERENCES Users(username)
);
CREATE TABLE Files(
    ID_File INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    content MEDIUMBLOB NOT NULL,
    extension VARCHAR(10),
    ID_Question INTEGER NOT NULL,
    Id_Answer INTEGER NOT NULL,
    FOREIGN KEY(ID_Answer) REFERENCES Answers(ID_Answer) ON DELETE CASCADE,
    FOREIGN KEY(ID_Question) REFERENCES Questions(ID_Question) ON DELETE CASCADE
);

INSERT INTO Matters(name, sect) VALUES ("Matematica","5°"),("Lingua e letteratura italiana","5°"),
("Storia, cittadinanza e costituzione","5°"),("Lingua inglese","5°"),("Informatica","5° informatica"),
("Sistemi e reti","5° informatica"),("Scienze motorie e sportive","5°"),
("Religione cattolica o attività alternative","5°"),
("Tecnologie e progettazione di sistemi informatici e di telecomunicazioni","5° informatica"),
("Gestione progetto, organizzazione d'impresa","5° informatica");

INSERT INTO Questions(title,description,username,name,sect,date_time) VALUES 
("TEST","descrizione del test. descrizione di esempio","bel24623","Lingua e letteratura italiana","5°",NOW());
  
INSERT INTO Answers(description,correct,ID_question,username,date_time) VALUES ("risposta test",false,2,"bel24623",NOW()),
("risposta test",false,1,"bel24623",NOW()),("risposta test",false,3,"bel24623",NOW()),
("risposta test",false,4,"bel24623",NOW()),("risposta test",false,2,"bel24623",NOW()),("risposta test",false,2,"bel24623",NOW());