
-- sql script to create the database

-- Drop tables if they exist
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS posts CASCADE;
DROP TABLE IF EXISTS comments CASCADE;
DROP TABLE IF EXISTS sublueddits CASCADE;
DROP TABLE IF EXISTS profilepics CASCADE;
DROP TABLE IF EXISTS usageTracking CASCADE;

CREATE TABLE users (
    userid INT UNIQUE NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    about VARCHAR(500),
    country VARCHAR(50),
    totalUpvotes INT DEFAULT 0,
    profilepath VARCHAR(100) DEFAULT 'res/img/person-circle.svg',
    isadmin BOOLEAN DEFAULT 0,
    isbanned BOOLEAN DEFAULT 0,
    isguest BOOLEAN DEFAULT 0,
    PRIMARY KEY(userid)
);

CREATE TABLE sublueddits (
    sid INT UNIQUE NOT NULL AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    description VARCHAR(500),
    PRIMARY KEY(sid)
);

CREATE TABLE posts (
    pid INT AUTO_INCREMENT,
    title VARCHAR(500) NOT NULL,
    content TEXT,
    link VARCHAR(500),
    upvotes INT DEFAULT 0,
    upvoted_users VARCHAR(1000) DEFAULT '',
    userid INT NOT NULL,
    sid INT,
    PRIMARY KEY(pid),
    FOREIGN KEY(userid) REFERENCES users(userid) ON UPDATE CASCADE ON DELETE NO ACTION,
    FOREIGN KEY(sid) REFERENCES sublueddits(sid) ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE comments (
    cid INT UNIQUE NOT NULL AUTO_INCREMENT,
    content TEXT,
    upvotes INT DEFAULT 0,
    upvoted_users VARCHAR(1000) DEFAULT '',
    userid INT NOT NULL,
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

CREATE TABLE usageTracking (
    entryID INT UNIQUE NOT NULL AUTO_INCREMENT,
    sid INT,
    type VARCHAR(16) NOT NULL,
    entryDate date NOT NULL,
    PRIMARY KEY(entryID),
    FOREIGN KEY(sid) REFERENCES sublueddits(sid) ON UPDATE CASCADE ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- sample data to insert:

INSERT INTO users (username, password, email, country, about, totalUpvotes, profilePath, isadmin, isbanned, isguest)
VALUES
    ('Teddy2014', '827ccb0eea8a706c4c34a16891f84e7b', 'Teddy2014@example.com', 'Canada', 'I love cosc360!', 100, 'res/img/Teddy2014.svg', 0, 0, 0),
    ('Meerkat', '827ccb0eea8a706c4c34a16891f84e7b', 'Meerkat@example.com', 'Canada', "Me hehe", 50, 'res/img/Meerkat.svg', 0, 0, 0),
    ('RedPanda', '21232f297a57a5a743894a0e4a801fc3', 'RedPanda@example.com', 'USA', "Yeet", 0, 'res/img/RedPanda.svg', 1, 0, 0),
    ('SeaOtter', '827ccb0eea8a706c4c34a16891f84e7b', 'SeaOtter@example.com', 'Australia', "We're looking at sea otters", 0, 'res/img/SeaOtter.svg', 0, 1, 0),
    ('Guest', '084e0343a0486ff05530df6c705c8bb4', 'guest@example.com', 'Canada', " ", 0, 'res/img/Guest.svg', 0, 0, 1);


INSERT INTO sublueddits (title, description)
VALUES 
    ('OrangeCentral', 'We love Oranges'),
    ('BananaCentral', 'We love Bananas'),
    ('AppleCentral', 'We love Apples'),
    ('COSC360Central', 'We love this course');

INSERT INTO posts (title, content, link, upvotes, userid, sid)
VALUES 
 ('Hello world! First timer here, what are the good stuff about Blueddit?', 'Is it just Reddit but bluer? XD', NULL, 10, 1, 1),
('If a colossal banana spun around the Earth', 'That banana is WAAAAAY too close lol. Sorry for stealing a link from Reddit.', 'https://v.redd.it/ihcr7nmh59na1', 5, 2, 2),
('Me when I wake up at 3 am dying of thirst but my cats are all comfy so I''m not allowed to move', '', 'https://i.redd.it/huli9hzmev381.jpg', 2, 3, 3),
('Is COSC360 a trap? I''m considering taking it next year', 'any feedback will be appreciated :)', NULL, 0, 4, 4);

-- Sample data for Comments table
INSERT INTO comments (content, upvotes, userid, pid)
VALUES 
    ('I love Oranges too', 10, 1, 1),
    ('I love Bananas too', 5, 2, 2),
    ('I love Apples too', 2, 3, 3),
    ('I love COSC 360 too!!!', 0, 4, 4);

INSERT INTO `usageTracking` (`sid`, `type`, `entryDate`) VALUES
(NULL, 'LOGIN', '2023-02-06'),
(4, 'VIEWPOST', '2023-03-06'),
(1, 'POST', '2023-03-06'),
(1, 'VIEWPOST', '2023-03-07'),
(4, 'VIEWPOST', '2023-03-06');