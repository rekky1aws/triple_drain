USE PinballFX_ranking;

/******************************************************************************
* Hate ladder                                                                 * 
******************************************************************************/
CREATE OR REPLACE VIEW Hate_ladder AS
SELECT
    actual_ladder.rank "Rank",
    actual_ladder.pseudo "Player pseudo",
    actual_ladder.points "Points",
    (CASE WHEN previous_ladder.rank IS NOT NULL THEN CAST(previous_ladder.rank AS DECIMAL(20, 0)) - CAST(actual_ladder.rank AS DECIMAL(20, 0)) END) "Rank improvement",
    (CASE WHEN previous_ladder.points IS NOT NULL THEN CAST(actual_ladder.points AS DECIMAL(20, 0)) - CAST(previous_ladder.points AS DECIMAL(20, 0)) END) "Points improvement",
    IF(actual_ladder.has_cheated = 0,'no','yes') as "Has cheated"
FROM
    (SELECT
        RANK() OVER (
            ORDER BY SUM(hso.hate_points) DESC
        ) "rank", 
        pl.pseudo "pseudo", 
        SUM(hso.hate_points) "points",
        pl.has_cheated
    FROM Player pl, Has_scored_on hso
    WHERE pl.id = hso.player_id
    AND hso.month_and_year = date_format(date_add(sysdate(), interval -1 month), '%Y-%m')
    GROUP BY pl.id) actual_ladder
    
LEFT JOIN

    (SELECT
        RANK() OVER (
            ORDER BY SUM(hso.hate_points) DESC
        ) "rank", 
        pl.pseudo "pseudo", 
        SUM(hso.hate_points) "points"
    FROM Player pl, Has_scored_on hso
    WHERE pl.id = hso.player_id
    AND hso.month_and_year = date_format(date_add(sysdate(), interval -2 month), '%Y-%m')
    GROUP BY pl.id) previous_ladder
    
ON actual_ladder.pseudo = previous_ladder.pseudo
ORDER BY actual_ladder.rank;

/******************************************************************************
* Pain ladder                                                                 * 
******************************************************************************/
CREATE OR REPLACE VIEW Pain_ladder AS
SELECT
    actual_ladder.rank "Rank",
    actual_ladder.pseudo "Player pseudo",
    actual_ladder.points "Points",
    (CASE WHEN previous_ladder.rank IS NOT NULL THEN CAST(previous_ladder.rank AS DECIMAL(20, 0)) - CAST(actual_ladder.rank AS DECIMAL(20, 0)) END) "Rank improvement",
    (CASE WHEN previous_ladder.points IS NOT NULL THEN CAST(actual_ladder.points AS DECIMAL(20, 0)) - CAST(previous_ladder.points AS DECIMAL(20, 0)) END) "Points improvement",
    IF(actual_ladder.has_cheated = 0,'no','yes') as "Has cheated"
FROM
    (SELECT
        RANK() OVER (
            ORDER BY SUM(hso.pain_points) DESC
        ) "rank", 
        pl.pseudo "pseudo", 
        SUM(hso.pain_points) "points",
        pl.has_cheated
    FROM Player pl, Has_scored_on hso
    WHERE pl.id = hso.player_id
    AND hso.month_and_year = date_format(date_add(sysdate(), interval -1 month), '%Y-%m')
    GROUP BY pl.id) actual_ladder
    
LEFT JOIN

    (SELECT
        RANK() OVER (
            ORDER BY SUM(hso.pain_points) DESC
        ) "rank", 
        pl.pseudo "pseudo", 
        SUM(hso.pain_points) "points"
    FROM Player pl, Has_scored_on hso
    WHERE pl.id = hso.player_id
    AND hso.month_and_year = date_format(date_add(sysdate(), interval -2 month), '%Y-%m')
    GROUP BY pl.id) previous_ladder
    
ON actual_ladder.pseudo = previous_ladder.pseudo
ORDER BY actual_ladder.rank;


/******************************************************************************
* Hate ladder for team                                                        * 
******************************************************************************/
CREATE OR REPLACE VIEW Team_Hate_ladder AS
SELECT
    actual_ladder.rank "Rank",
    actual_ladder.name "Team name",
    actual_ladder.points "Points",
    (CASE WHEN previous_ladder.rank IS NOT NULL THEN CAST(previous_ladder.rank AS DECIMAL(20, 0)) - CAST(actual_ladder.rank AS DECIMAL(20, 0)) END) "Rank improvement",
    (CASE WHEN previous_ladder.points IS NOT NULL THEN CAST(actual_ladder.points AS DECIMAL(20, 0)) - CAST(previous_ladder.points AS DECIMAL(20, 0)) END) "Points improvement"
FROM
    (SELECT
        RANK() OVER (
            ORDER BY SUM(hso.hate_points) DESC
        ) "rank", 
        t.name "name", 
        SUM(hso.hate_points) "points"
    FROM Player pl, Has_scored_on hso, Team t
    WHERE pl.id = hso.player_id
    AND t.id = pl.team_id
    AND hso.month_and_year = date_format(date_add(sysdate(), interval -1 month), '%Y-%m')
    GROUP BY t.id) actual_ladder
    
LEFT JOIN

    (SELECT
        RANK() OVER (
            ORDER BY SUM(hso.hate_points) DESC
        ) "rank", 
        t.name "name", 
        SUM(hso.hate_points) "points"
    FROM Player pl, Has_scored_on hso, Team t
    WHERE pl.id = hso.player_id
    AND t.id = pl.team_id
    AND hso.month_and_year = date_format(date_add(sysdate(), interval -2 month), '%Y-%m')
    GROUP BY t.id) previous_ladder
    
ON actual_ladder.name = previous_ladder.name
ORDER BY actual_ladder.rank;

/******************************************************************************
* Pain ladder for team                                                        * 
******************************************************************************/
CREATE OR REPLACE VIEW Team_Pain_ladder AS
SELECT
    actual_ladder.rank "Rank",
    actual_ladder.name "Team name",
    actual_ladder.points "Points",
    (CASE WHEN previous_ladder.rank IS NOT NULL THEN CAST(previous_ladder.rank AS DECIMAL(20, 0)) - CAST(actual_ladder.rank AS DECIMAL(20, 0)) END) "Rank improvement",
    (CASE WHEN previous_ladder.points IS NOT NULL THEN CAST(actual_ladder.points AS DECIMAL(20, 0)) - CAST(previous_ladder.points AS DECIMAL(20, 0)) END) "Points improvement"
FROM
    (SELECT
        RANK() OVER (
            ORDER BY SUM(hso.pain_points) DESC
        ) "rank", 
        t.name "name", 
        SUM(hso.pain_points) "points"
    FROM Player pl, Has_scored_on hso, Team t
    WHERE pl.id = hso.player_id
    AND t.id = pl.team_id
    AND hso.pain_points IS NOT NULL
    AND hso.month_and_year = date_format(date_add(sysdate(), interval -1 month), '%Y-%m')
    GROUP BY t.id) actual_ladder
    
LEFT JOIN

    (SELECT
        RANK() OVER (
            ORDER BY SUM(hso.pain_points) DESC
        ) "rank", 
        t.name "name", 
        SUM(hso.pain_points) "points"
    FROM Player pl, Has_scored_on hso, Team t
    WHERE pl.id = hso.player_id
    AND t.id = pl.team_id
    AND hso.pain_points IS NOT NULL
    AND hso.month_and_year = date_format(date_add(sysdate(), interval -2 month), '%Y-%m')
    GROUP BY t.id) previous_ladder
    
ON actual_ladder.name = previous_ladder.name
ORDER BY actual_ladder.rank;

/******************************************************************************
* Hate ladder by Category                                                     * 
******************************************************************************/
CREATE OR REPLACE VIEW Category_Hate_ladder AS
SELECT
    actual_ladder.Category "Pinball category",
    actual_ladder.rank "Rank",
    actual_ladder.pseudo "Player pseudo",
    actual_ladder.points "Points",
    (CASE WHEN previous_ladder.rank IS NOT NULL THEN CAST(previous_ladder.rank AS DECIMAL(20, 0)) - CAST(actual_ladder.rank AS DECIMAL(20, 0)) END) "Rank improvement",
    (CASE WHEN previous_ladder.points IS NOT NULL THEN CAST(actual_ladder.points AS DECIMAL(20, 0)) - CAST(previous_ladder.points AS DECIMAL(20, 0)) END) "Points improvement",
    IF(actual_ladder.has_cheated = 0,'no','yes') as "Has cheated"
FROM
    (SELECT
        RANK() OVER (
            PARTITION BY cat.name
            ORDER BY SUM(hso.hate_points) DESC
        ) "rank", 
        cat.name "Category", 
        pl.pseudo "Pseudo", 
        SUM(hso.hate_points) "points",
        pl.has_cheated
    FROM Player pl, Has_scored_on hso, pinball pin, Category cat
    WHERE pl.id = hso.player_id
    AND pin.id = hso.pinball_id
    AND cat.id = pin.category_id
    AND hso.month_and_year = date_format(date_add(sysdate(), interval -1 month), '%Y-%m')
    GROUP BY cat.name,pl.pseudo) actual_ladder
    
LEFT JOIN

    (SELECT
        RANK() OVER (
            PARTITION BY cat.name
            ORDER BY SUM(hso.hate_points) DESC
        ) "rank", 
        cat.name "Category", 
        pl.pseudo "Pseudo", 
        SUM(hso.hate_points) "points"
    FROM Player pl, Has_scored_on hso, pinball pin, Category cat
    WHERE pl.id = hso.player_id
    AND pin.id = hso.pinball_id
    AND cat.id = pin.category_id
    AND hso.month_and_year = date_format(date_add(sysdate(), interval -2 month), '%Y-%m')
    GROUP BY cat.name,pl.pseudo) previous_ladder
    
ON actual_ladder.pseudo = previous_ladder.pseudo AND actual_ladder.Category = previous_ladder.Category
ORDER BY actual_ladder.category, actual_ladder.rank;

/******************************************************************************
* Pain ladder by Category                                                     * 
******************************************************************************/
CREATE OR REPLACE VIEW Category_Pain_ladder AS
SELECT
    actual_ladder.Category "Pinball category",
    actual_ladder.rank "Rank",
    actual_ladder.pseudo "Player pseudo",
    actual_ladder.points "Points",
    (CASE WHEN previous_ladder.rank IS NOT NULL THEN CAST(previous_ladder.rank AS DECIMAL(20, 0)) - CAST(actual_ladder.rank AS DECIMAL(20, 0)) END) "Rank improvement",
    (CASE WHEN previous_ladder.points IS NOT NULL THEN CAST(actual_ladder.points AS DECIMAL(20, 0)) - CAST(previous_ladder.points AS DECIMAL(20, 0)) END) "Points improvement",
    IF(actual_ladder.has_cheated = 0,'no','yes') as "Has cheated"
FROM
    (SELECT
        RANK() OVER (
            PARTITION BY cat.name
            ORDER BY SUM(hso.pain_points) DESC
        ) "rank", 
        cat.name "Category", 
        pl.pseudo "Pseudo", 
        SUM(hso.pain_points) "points",
        pl.has_cheated
    FROM Player pl, Has_scored_on hso, pinball pin, Category cat
    WHERE pl.id = hso.player_id
    AND pin.id = hso.pinball_id
    AND cat.id = pin.category_id
    AND hso.pain_points IS NOT NULL
    AND hso.month_and_year = date_format(date_add(sysdate(), interval -1 month), '%Y-%m')
    GROUP BY cat.name,pl.pseudo) actual_ladder
    
LEFT JOIN

    (SELECT
        RANK() OVER (
            PARTITION BY cat.name
            ORDER BY SUM(hso.pain_points) DESC
        ) "rank", 
        cat.name "Category", 
        pl.pseudo "Pseudo", 
        SUM(hso.pain_points) "points"
    FROM Player pl, Has_scored_on hso, pinball pin, Category cat
    WHERE pl.id = hso.player_id
    AND pin.id = hso.pinball_id
    AND cat.id = pin.category_id
    AND hso.pain_points IS NOT NULL
    AND hso.month_and_year = date_format(date_add(sysdate(), interval -2 month), '%Y-%m')
    GROUP BY cat.name,pl.pseudo) previous_ladder
ON actual_ladder.pseudo = previous_ladder.pseudo AND actual_ladder.Category = previous_ladder.Category
ORDER BY actual_ladder.category, actual_ladder.rank;

-- SETTING des points
UPDATE Has_scored_on
SET Hate_points =  100 - (position - 1)
WHERE Hate_points IS NULL;

UPDATE Has_scored_on
SET Pain_points =  100 - ((position - 1) * 2)
WHERE Position <= 51
AND Pain_points IS NULL;

-- Verification d'execution d'inserts
SELECT Month_and_year, Pinball_Id, COUNT(*)
FROM HAS_SCORED_ON
GROUP BY Month_and_year, Pinball_Id
HAVING COUNT(*) <100;


SELECT pin.name,hso.position
FROM HAS_SCORED_ON hso, PINBALL pin
WHERE hso.pinball_id = '4'
AND hso.month_and_year = '2024-08'
AND pin.id = hso.pinball_id
ORDER BY position;

