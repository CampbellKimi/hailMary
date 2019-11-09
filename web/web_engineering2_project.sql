CREATE DATABASE rock_paper_scissors;


  CREATE TABLE reezys (
    game_id SERIAL PRIMARY KEY,
    win BOOLEAN,
    loss BOOLEAN,
    input VARCHAR(9) NOT NULL
  );

    CREATE TABLE wins (
    game_id INT NOT NULL REFERENCES results(game_id),
    win BOOLEAN,
    rock BOOLEAN NOT NULL, results,
    paper BOOLEAN NOT NULL,
    scissors BOOLEAN NOT NULL,
  );

    CREATE TABLE losses (
    game_id INT NOT NULL REFERENCES results(game_id),
    loss BOOLEAN,
    rock BOOLEAN NOT NULL,
    paper BOOLEAN NOT NULL,
    scissors BOOLEAN NOT NULL,
  );
