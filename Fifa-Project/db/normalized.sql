USE fifa_db;

DROP TABLE IF EXISTS Player_Info;
CREATE TABLE IF NOT EXISTS Player_Info (
	futbin_id INT UNSIGNED,
    player_name VARCHAR(35),
	player_extended_name VARCHAR(50),
    nationality VARCHAR(17),
	position VARCHAR(4),
    overall CHAR(3),
    intl_rep INT,
    
    PRIMARY KEY(futbin_id)
);

DROP TABLE IF EXISTS Club_Info;
CREATE TABLE IF NOT EXISTS Club_Info (
	futbin_id INT UNSIGNED,
    club VARCHAR(25),
	league VARCHAR(25),
    
     PRIMARY KEY(futbin_id)
);

DROP TABLE IF EXISTS Player_Demographic;
CREATE TABLE IF NOT EXISTS Player_Demographic (
	futbin_id INT UNSIGNED,
    age TINYINT UNSIGNED,
	date_of_birth DATE,
	height TINYINT UNSIGNED,
	weight TINYINT UNSIGNED,
    
     PRIMARY KEY(futbin_id)
);

DROP TABLE IF EXISTS Player_Attributes;
CREATE TABLE IF NOT EXISTS Player_Attributes (
	futbin_id INT UNSIGNED,
    pace MEDIUMINT,
    dribbling TINYINT UNSIGNED,
    shooting TINYINT UNSIGNED,
    passing TINYINT UNSIGNED,
    defending TINYINT UNSIGNED,
    physicality TINYINT UNSIGNED,
    
	PRIMARY KEY(futbin_id)
);

DROP TABLE IF EXISTS Player_Pace;
CREATE TABLE IF NOT EXISTS Player_Pace (
	futbin_id INT UNSIGNED,
	pace_acceleration TINYINT UNSIGNED,
	pace_sprint_speed TINYINT UNSIGNED,
    
	PRIMARY KEY(futbin_id)
);

DROP TABLE IF EXISTS Player_Dribbling;
CREATE TABLE IF NOT EXISTS Player_Dribbling (
	futbin_id INT UNSIGNED,
    drib_agility TINYINT UNSIGNED,
	drib_balance TINYINT UNSIGNED,
	drib_reactions TINYINT UNSIGNED,
	drib_ball_control TINYINT UNSIGNED,
	drib_dribbling TINYINT UNSIGNED,
	drib_composure TINYINT UNSIGNED,
    pref_foot VARCHAR(5),
    weak_foot TINYINT UNSIGNED,
    
    PRIMARY KEY(futbin_id)
);

DROP TABLE IF EXISTS Player_Shooting;
CREATE TABLE IF NOT EXISTS Player_Shooting (
	futbin_id INT UNSIGNED,
    shoot_positioning TINYINT UNSIGNED,
	shoot_finishing TINYINT UNSIGNED,
	shoot_shot_power TINYINT UNSIGNED,
	shoot_long_shots TINYINT UNSIGNED,
	shoot_volleys TINYINT UNSIGNED,
	shoot_penalties TINYINT UNSIGNED,
    
    PRIMARY KEY(futbin_id)
);

DROP TABLE IF EXISTS Player_Passing;
CREATE TABLE IF NOT EXISTS Player_Passing (
	futbin_id INT UNSIGNED,
    pass_vision TINYINT UNSIGNED,
	pass_crossing TINYINT UNSIGNED,
	pass_free_kick TINYINT UNSIGNED,
	pass_short TINYINT UNSIGNED,
	pass_long TINYINT UNSIGNED,
	pass_curve TINYINT UNSIGNED,
    
    PRIMARY KEY(futbin_id)
);

DROP TABLE IF EXISTS Player_Defending;
CREATE TABLE IF NOT EXISTS Player_Defending (
	futbin_id INT UNSIGNED,
	def_interceptions TINYINT UNSIGNED,
	def_heading TINYINT UNSIGNED,
	def_marking TINYINT UNSIGNED,
	def_stand_tackle TINYINT UNSIGNED,
	def_slid_tackle TINYINT UNSIGNED,
    
    PRIMARY KEY(futbin_id)
);

DROP TABLE IF EXISTS Player_Physicality;
CREATE TABLE IF NOT EXISTS Player_Physicality (
	futbin_id INT UNSIGNED,
    phys_jumping TINYINT UNSIGNED,
	phys_stamina TINYINT UNSIGNED,
	phys_strength TINYINT UNSIGNED,
	phys_aggression TINYINT UNSIGNED,
    
    PRIMARY KEY(futbin_id)
);

DROP TABLE IF EXISTS Player_Gk;
CREATE TABLE IF NOT EXISTS Player_Gk (
	futbin_id INT UNSIGNED,
    gk_diving TINYINT UNSIGNED,
	gk_reflexes TINYINT UNSIGNED,
	gk_handling TINYINT UNSIGNED,
	gk_speed TINYINT UNSIGNED,
	gk_kicking TINYINT UNSIGNED,
	gk_positoning TINYINT UNSIGNED,
    
    PRIMARY KEY(futbin_id)
);

DROP TABLE IF EXISTS Player_Position;
CREATE TABLE IF NOT EXISTS Player_Position (
	futbin_id INT UNSIGNED,
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
    
    PRIMARY KEY(futbin_id)
);

DROP TABLE IF EXISTS Player_Miscellaneous;
CREATE TABLE IF NOT EXISTS Player_Miscellaneous(
	futbin_id INT UNSIGNED,
    quality VARCHAR(15),
	revision VARCHAR(12),
	origin VARCHAR(10),
	added_date DATE,
    skill_moves TINYINT UNSIGNED,
    att_workrate VARCHAR(5),
	def_workrate VARCHAR (5),
    
    PRIMARY KEY(futbin_id)
);

--

INSERT INTO Player_Info
SELECT futbin_id, player_name, player_extended_name, nationality, position, overall, intl_rep
FROM mega_fifa;

INSERT INTO Club_Info
SELECT futbin_id, club, league
FROM mega_fifa;

INSERT INTO Player_Demographic
SELECT futbin_id, age, date_of_birth, height, weight
FROM mega_fifa;

INSERT INTO Player_Attributes
SELECT futbin_id, pace, dribbling, shooting, passing, defending, physicality
FROM mega_fifa;

INSERT INTO Player_Pace
SELECT futbin_id, pace_acceleration, pace_sprint_speed
FROM mega_fifa;

INSERT INTO Player_Dribbling
SELECT futbin_id, drib_agility, drib_balance, drib_reactions, drib_ball_control, drib_dribbling, drib_composure, pref_foot, weak_foot
FROM mega_fifa;

INSERT INTO Player_Shooting
SELECT futbin_id, shoot_positioning, shoot_finishing, shoot_shot_power, shoot_long_shots, shoot_volleys, shoot_penalties
FROM mega_fifa;

INSERT INTO Player_Passing
SELECT futbin_id, pass_vision, pass_crossing, pass_free_kick, pass_short, pass_long, pass_curve
FROM mega_fifa;

INSERT INTO Player_Defending
SELECT futbin_id, def_interceptions, def_heading, def_marking, def_stand_tackle, def_slid_tackle
FROM mega_fifa;

INSERT INTO Player_Physicality
SELECT futbin_id, phys_jumping, phys_stamina, phys_strength, phys_aggression
FROM mega_fifa;

INSERT INTO Player_Gk
SELECT futbin_id, gk_diving, gk_reflexes, gk_handling, gk_speed, gk_kicking, gk_positoning
FROM mega_fifa;

INSERT INTO Player_Position
SELECT futbin_id, cb, rb, lb, rwb, lwb, cdm, cm, rm, lm, cam, cf, rf, lf, rw, lw, st
FROM mega_fifa;

INSERT INTO Player_Miscellaneous
SELECT futbin_id, quality, revision, origin, added_date, skill_moves, att_workrate, def_workrate
FROM mega_fifa;

