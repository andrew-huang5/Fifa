CREATE DATABASE IF NOT EXISTS fifa_db;
USE fifa_db;

DROP TABLE IF EXISTS mega_fifa;
CREATE TABLE IF NOT EXISTS mega_fifa
	(futbin_id INT UNSIGNED,
	player_name VARCHAR(35),
	player_extended_name VARCHAR(50),
	quality VARCHAR(15),
	revision VARCHAR(12),
	origin VARCHAR(10),
	overall CHAR(3),
	club VARCHAR(25),
	league VARCHAR(25),
	nationality VARCHAR(17),
	position VARCHAR(4),
	age TINYINT UNSIGNED,
	date_of_birth DATE,
	height TINYINT UNSIGNED,
	weight TINYINT UNSIGNED,
	intl_rep INT,
	added_date DATE,
	pace MEDIUMINT,
	pace_acceleration TINYINT UNSIGNED,
	pace_sprint_speed TINYINT UNSIGNED,
	dribbling TINYINT UNSIGNED,
	drib_agility TINYINT UNSIGNED,
	drib_balance TINYINT UNSIGNED,
	drib_reactions TINYINT UNSIGNED,
	drib_ball_control TINYINT UNSIGNED,
	drib_dribbling TINYINT UNSIGNED,
	drib_composure TINYINT UNSIGNED,
	shooting TINYINT UNSIGNED,
	shoot_positioning TINYINT UNSIGNED,
	shoot_finishing TINYINT UNSIGNED,
	shoot_shot_power TINYINT UNSIGNED,
	shoot_long_shots TINYINT UNSIGNED,
	shoot_volleys TINYINT UNSIGNED,
	shoot_penalties TINYINT UNSIGNED,
	passing TINYINT UNSIGNED,
	pass_vision TINYINT UNSIGNED,
	pass_crossing TINYINT UNSIGNED,
	pass_free_kick TINYINT UNSIGNED,
	pass_short TINYINT UNSIGNED,
	pass_long TINYINT UNSIGNED,
	pass_curve TINYINT UNSIGNED,
	defending TINYINT UNSIGNED,
	def_interceptions TINYINT UNSIGNED,
	def_heading TINYINT UNSIGNED,
	def_marking TINYINT UNSIGNED,
	def_stand_tackle TINYINT UNSIGNED,
	def_slid_tackle TINYINT UNSIGNED,
	physicality TINYINT UNSIGNED,
	phys_jumping TINYINT UNSIGNED,
	phys_stamina TINYINT UNSIGNED,
	phys_strength TINYINT UNSIGNED,
	phys_aggression TINYINT UNSIGNED,
	gk_diving TINYINT UNSIGNED,
	gk_reflexes TINYINT UNSIGNED,
	gk_handling TINYINT UNSIGNED,
	gk_speed TINYINT UNSIGNED,
	gk_kicking TINYINT UNSIGNED,
	gk_positoning TINYINT UNSIGNED,
	pref_foot VARCHAR(5),
	att_workrate VARCHAR(5),
	def_workrate VARCHAR (5), 
	weak_foot TINYINT UNSIGNED,
	skill_moves TINYINT UNSIGNED,
	cb TINYINT UNSIGNED,
	rb TINYINT UNSIGNED,
	lb TINYINT UNSIGNED,
	rwb TINYINT UNSIGNED,
	lwb TINYINT UNSIGNED,
	cdm TINYINT UNSIGNED,
	cm TINYINT UNSIGNED,
	rm TINYINT UNSIGNED,
	lm TINYINT UNSIGNED,
	cam TINYINT UNSIGNED,
	cf TINYINT UNSIGNED,
	rf TINYINT UNSIGNED,
	lf TINYINT UNSIGNED,
	rw TINYINT UNSIGNED,
	lw TINYINT UNSIGNED,
	st TINYINT UNSIGNED,
	traits VARCHAR(75),
	specialities VARCHAR(75),
	base_id INT,
	resource_id INT,
	ps4_last INT UNSIGNED,
	ps4_min INT UNSIGNED,
	ps4_max INT UNSIGNED,
	ps4_prp TINYINT UNSIGNED,
	xbox_last INT UNSIGNED,
	xbox_min INT UNSIGNED,
	xbox_max INT UNSIGNED,
	xbox_prp TINYINT UNSIGNED,
	pc_last INT UNSIGNED,
	pc_min INT UNSIGNED,
	pc_max INT UNSIGNED,
	pc_prp TINYINT UNSIGNED
    );
    
DROP TABLE IF EXISTS mega_prices;
CREATE TABLE IF NOT EXISTS mega_prices
	(futbin_id INT UNSIGNED,
    date_ DATE,
	ps4 INT UNSIGNED,
	xbox INT UNSIGNED,
    pc INT UNSIGNED
    );
    
SET GLOBAL sql_mode = "";
SELECT @@sql_mode;

/*must change file path*/
LOAD DATA INFILE 'c:/wamp64/tmp/fut_bin19_players.csv' 
INTO TABLE mega_fifa
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
IGNORE 1 LINES;

/*must change file path*/
LOAD DATA INFILE 'c:/wamp64/tmp/fut_bin19_prices.csv' 
INTO TABLE mega_prices
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
IGNORE 1 LINES;