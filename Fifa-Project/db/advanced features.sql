SET SQL_SAFE_UPDATES=0;

-- Procedure 1
DROP PROCEDURE IF EXISTS getPlayerID;

DELIMITER //

CREATE PROCEDURE getPlayerID(playername VARCHAR(35))

BEGIN

	 SELECT futbin_id 
     FROM Player_Info
     WHERE player_name = playername;

END //

DELIMITER ; 

/*CALL getPlayer("Messi");*/

-- Procedure 2
DROP PROCEDURE IF EXISTS findPlayer;

DELIMITER //

CREATE PROCEDURE findPlayer(playerid INT UNSIGNED)

BEGIN
	 
     SELECT * 
     FROM mega_fifa
     WHERE futbin_id = playerid;

END //

DELIMITER ; 


-- View 1
DROP VIEW playerSkills;
CREATE VIEW playerSkills AS 
SELECT *
FROM Player_Pace A
	 JOIN Player_Dribbling B ON A.futbin_id = B.futbin_id
     JOIN Player_Shooting C ON A.futbin_id = C.futbin_id
     JOIN Player_Passing D ON A.futbin_id = D.futbin_id
     JOIN Player_Defending E ON A.futbin_id = E.futbin_id
     JOIN Player_Physicality F ON A.futbin_id = F.futbin_id
     JOIN Player_Gk G ON A.futbin_id = G.futbin_id
ORDER BY futbin_id DESC;

-- 
DROP PROCEDURE IF EXISTS findSkills;

DELIMITER //

-- Procedure 3
CREATE PROCEDURE findSkills(playername VARCHAR(35))

BEGIN
	 
     SELECT * 
     FROM playerSkills
     WHERE futbin_id IN (SELECT futbin_id
		FROM Player_Info
        WHERE player_name = playername);
		

END //

DELIMITER ; 

-- Procedure 4
DROP PROCEDURE IF EXISTS findSkills1;

DELIMITER //

CREATE PROCEDURE findSkills1(playerid INT UNSIGNED)

BEGIN
	 
     SELECT * 
     FROM playerSkills
     WHERE futbin_id = playerid;
		

END //

DELIMITER ; 

-- View 2
DROP VIEW player_info_view;
CREATE VIEW player_info_view AS
SELECT futbin_id, player_extended_name, player_name, overall, quality, club
FROM player_info;

-- Trigger 1
DROP TRIGGER IF EXISTS Before_Insert_Player;
DELIMITER $$
CREATE TRIGGER Before_Insert_Player
BEFORE INSERT ON player_info
FOR EACH ROW
BEGIN
IF EXISTS(SELECT 1 FROM player_info WHERE player_extended_name = NEW.player_extended_name) THEN
	SIGNAL SQLSTATE VALUE '45000' SET MESSAGE_TEXT = 'INSERT failed due to duplicate player';
END IF;
END$$
DELIMITER ;


-- Procedure 5
DROP PROCEDURE IF EXISTS insertPlayer;

DELIMITER //

CREATE PROCEDURE insertPlayer(IN player VARCHAR(45), IN overall1 INT)

BEGIN 

#if the player is already in the table, won;t go through

INSERT INTO player_info (player_extended_name, overall)
VALUES (player, overall1);

END //

-- Procedure 6
DROP PROCEDURE IF EXISTS updatePlayer;

DELIMITER //

CREATE PROCEDURE updatePlayer(IN player VARCHAR(45), IN overall_ VARCHAR(3))

BEGIN 

UPDATE player_info_view 
SET overall = overall_
WHERE player_extended_name = player;

END //

-- Procedure 7
DROP PROCEDURE IF EXISTS deletePlayer;

DELIMITER //

CREATE PROCEDURE deletePlayer(IN player VARCHAR(45))

BEGIN 

DELETE FROM player_info
WHERE player_extended_name = player;

END //


-- Procedure 8
DROP PROCEDURE IF EXISTS searchPlayerPrices;

DELIMITER //

CREATE PROCEDURE searchPlayerPrices(IN range1 INT, IN range2 INT)

BEGIN 

SELECT COUNT(ps4) AS ps4, COUNT(xbox) AS xbox, COUNT(pc) AS pc 
FROM mega_prices
WHERE ps4>range1 AND ps4<range2 AND xbox>range1 AND xbox<range2 AND pc>range1 AND pc<range2
LIMIT 14;

END //

-- Procedure 9
DROP PROCEDURE IF EXISTS searchPlayerInfo;

DELIMITER //

CREATE PROCEDURE searchPlayerInfo(IN player VARCHAR(45))

BEGIN 

DECLARE fid INT;
SET fid = (SELECT futbin_id FROM player_info_view WHERE player_extended_name = player LIMIT 1);

SELECT * FROM player_info WHERE futbin_id = fid;

END //

-- Procedure 10
DROP PROCEDURE IF EXISTS searchPlayerStats;

DELIMITER //

CREATE PROCEDURE searchPlayerStats(IN player VARCHAR(45))

BEGIN 

DECLARE fid INT;
SET fid = (SELECT futbin_id FROM player_info_view WHERE player_extended_name = player LIMIT 1);

SELECT * FROM player_attributes WHERE futbin_id = fid;

END //

-- Procedure 11
ROP PROCEDURE IF EXISTS searchPosition;

DELIMITER //

CREATE PROCEDURE searchPosition(IN pos VARCHAR(45))

BEGIN 

SELECT pos into @colname;
SET @table = 'player_position JOIN player_info 
USING (futbin_id)';
SET @query = CONCAT('SELECT DISTINCT (player_extended_name), futbin_id, quality, nationality, club, ',@colname,
' AS position FROM ', @table, 'ORDER BY ',@colname, ' DESC LIMIT 20');

PREPARE stmt FROM @query;
EXECUTE stmt;


END //

-- trigger 2
DROP TRIGGER IF EXISTS Before_Insert_Player2;
DELIMITER $$
CREATE TRIGGER Before_Insert_Player2
BEFORE INSERT ON player_info
FOR EACH ROW
BEGIN
IF EXISTS(SELECT 1 FROM player_info WHERE NEW.overall < 0) THEN
	SIGNAL SQLSTATE VALUE '45000' SET MESSAGE_TEXT = 'INSERT failed, must have positive overall';
END IF;
END$$
DELIMITER ;