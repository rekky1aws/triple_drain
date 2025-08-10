CREATE DATABASE IF NOT EXISTS PinballFX_ranking;
USE PinballFX_ranking;

DROP TABLE Has_Scored_On;
DROP TABLE Player;
DROP TABLE Team;
Drop Table Pinball;
Drop Table Category;

CREATE TABLE Category (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(250) NOT NULL
);

ALTER TABLE Category ADD CONSTRAINT Category_UNIQUE_Name UNIQUE (Name);

-------------------------------------------------------------------------------------

CREATE TABLE Pinball (
	Id				INT PRIMARY KEY AUTO_INCREMENT,
	Name				VARCHAR(250) NOT NULL,
	Category_Id  	INT NOT NULL
);

ALTER TABLE Pinball ADD CONSTRAINT Pinball_FK_Category_Id FOREIGN KEY (Category_Id) REFERENCES Category(Id);
ALTER TABLE Pinball ADD CONSTRAINT Pinball_UNIQUE_Name UNIQUE (Name);

-------------------------------------------------------------------------------------

CREATE TABLE Team (
	Id				INT PRIMARY KEY AUTO_INCREMENT,
	Name			VARCHAR(250) NOT NULL
);

ALTER TABLE Team ADD CONSTRAINT Team_UNIQUE_Name UNIQUE (Name);

-------------------------------------------------------------------------------------

CREATE TABLE Player (
	Id				INT PRIMARY KEY AUTO_INCREMENT,
	Pseudo			VARCHAR(250) NOT NULL,
    Has_cheated     INT DEFAULT 0,
	Team_Id   	    INT
);

ALTER TABLE Player ADD CONSTRAINT Player_FK_Team_id FOREIGN KEY (Team_Id) REFERENCES Team(Id);
ALTER TABLE Player ADD CONSTRAINT Player_UNIQUE_Pseudo UNIQUE (Pseudo);

-------------------------------------------------------------------------------------

CREATE TABLE Has_Scored_On (
	Player_Id		INT,
	Pinball_Id		INT,
	Position		INT NOT NULL,
	Month_and_year  VARCHAR(7) NOT NULL,
    Score           BIGINT NOT NULL,
	Hate_Points		INT,
	Pain_Points		INT
);

ALTER TABLE Has_Scored_On ADD CONSTRAINT Has_Scored_On_FK_Player_id FOREIGN KEY (Player_Id) REFERENCES Player(Id);
ALTER TABLE Has_Scored_On ADD CONSTRAINT Has_Scored_On_FK_Pinball_id FOREIGN KEY (Pinball_Id) REFERENCES Pinball(Id);
ALTER TABLE Has_Scored_On ADD CONSTRAINT Has_Scored_On_PK_PlayerId_PinballId_Month PRIMARY KEY (Player_Id, Pinball_Id, Month_and_year);
ALTER TABLE Has_Scored_On ADD CONSTRAINT Has_Scored_On_UNIQUE_PinballId_Month_Position UNIQUE (Month_and_year, Pinball_Id, Position);
ALTER TABLE Has_Scored_On ADD CONSTRAINT Has_Scored_On_CHECK_Hate_points_range CHECK (Hate_Points >= 0 AND Hate_Points <= 100 );
ALTER TABLE Has_Scored_On ADD CONSTRAINT Has_Scored_On_CHECK_Pain_points_range CHECK (Pain_Points >= 0 AND Pain_Points <= 100 );
ALTER TABLE Has_Scored_On ADD CONSTRAINT Has_Scored_On_CHECK_Position_range CHECK (Position >= 1 AND Position <= 100 );