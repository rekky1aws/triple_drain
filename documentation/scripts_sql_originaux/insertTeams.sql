USE PinballFX_ranking;

INSERT INTO Team (NAME) VALUES ('Team Enhancer');
UPDATE PLAYER SET Team_id = (SELECT ID FROM TEAM WHERE NAME = 'Team Enhancer') WHERE PSEUDO LIKE '%Enhancer%';
INSERT INTO Team (NAME) VALUES ('Team Flipper VR');
UPDATE PLAYER SET Team_id = (SELECT ID FROM TEAM WHERE NAME = 'Team Flipper VR') WHERE PSEUDO LIKE '%VR]%';