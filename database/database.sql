
-- sql script to create the database

-- Drop tables if they exist
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS posts CASCADE;
DROP TABLE IF EXISTS comments CASCADE;
DROP TABLE IF EXISTS sublueddits CASCADE;
DROP TABLE IF EXISTS profilepics CASCADE;

CREATE TABLE users (
    userid INT UNIQUE NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    about VARCHAR(500),
    country VARCHAR(50),
    totalUpvotes INT,
    profilepath VARCHAR(100),
    isadmin BOOLEAN,
    isbanned BOOLEAN,
    PRIMARY KEY(userid)
);

CREATE TABLE sublueddits (
    sid INT UNIQUE NOT NULL,
    title VARCHAR(50),
    description VARCHAR(500),
    PRIMARY KEY(sid)
);

CREATE TABLE posts (
    pid INT AUTO_INCREMENT,
    title VARCHAR(500),
    content TEXT,
    link VARCHAR(500),
    upvotes INT,
    userid INT,
    sid INT,
    PRIMARY KEY(pid),
    FOREIGN KEY(userid) REFERENCES users(userid) ON UPDATE CASCADE ON DELETE NO ACTION,
    FOREIGN KEY(sid) REFERENCES sublueddits(sid) ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE comments (
    cid INT UNIQUE NOT NULL AUTO_INCREMENT,
    content TEXT,
    upvotes INT,
    userid INT,
    pid INT,
    PRIMARY KEY(cid),
    FOREIGN KEY(userid) REFERENCES users(userid) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(pid) REFERENCES posts(pid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE profilepics (
    userid INT NOT NULL,
    contentType VARCHAR(255) NOT NULL,
    image BLOB NOT NULL,
    PRIMARY KEY(userid),
    FOREIGN KEY(userid) REFERENCES users(userid) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- sample data to insert:

INSERT INTO users (username, password, email, country, totalUpvotes, profilePath, isAdmin, isBanned)
VALUES
    ('Teddy2014', '12345', 'Teddy2014@example.com', 'Canada', 100, '/profiles/Teddy2014.jpg', 0, 0),
    ('Meerkat', '12345', 'Meerkat@example.com', 'Canada', 50, '/profiles/Meerkat.jpg', 0, 0),
    ('RedPanda', 'admin', 'RedPanda@example.com', 'USA', 0, '/profiles/RedPanda.jpg', 1, 0),
    ('SeaOtter', '12345', 'SeaOtter@example.com', 'Australia', 0, '/profiles/SeaOtter.jpg', 0, 1);

INSERT INTO sublueddits (sid, title, description)
VALUES 
    (1, 'OrangeCentral', 'We love Oranges'),
    (2, 'BananaCentral', 'We love Bananas'),
    (3, 'AppleCentral', 'We love Apples'),
    (4, 'COSC360Central', 'We hate this course');

INSERT INTO posts (title, content, link, upvotes, userid, sid)
VALUES 
    ('I love Oranges', 'I love Oranges, they are so tasty', NULL, 10, 1, 1),
    ('I love Bananas', 'I love Bananas, they are so tasty', NULL, 5, 2, 2),
    ('I love Apples', 'I love Apples, they are so tasty', NULL, 2, 3, 3),
    ('I hate COSC 360', 'I hate COSC 360, it is ridiculous', NULL, 0, 4, 4);

-- Sample data for Comments table
INSERT INTO comments (content, upvotes, userid, pid)
VALUES 
    ('I love Oranges too', 10, 1, 1),
    ('I love Bananas too', 5, 2, 2),
    ('I love Apples too', 2, 3, 3),
    ('I hate COSC 360 too', 0, 4, 4);