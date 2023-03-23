
--- sql script to create the database

-- Drop tables if they exist
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS posts CASCADE;
DROP TABLE IF EXISTS comments CASCADE;
DROP TABLE IF EXISTS subreddits CASCADE;
DROP TABLE IF EXISTS profile_pics CASCADE;

CREATE TABLE users (
    user_id INT UNIQUE NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    bio VARCHAR(500),
    country VARCHAR(50),
    total_upvotes INT,
    profile_picture_path VARCHAR(100),
    is_admin BOOLEAN,
    is_banned BOOLEAN,
    PRIMARY KEY(user_id)
);

CREATE TABLE subreddits (
    subreddit_id INT UNIQUE NOT NULL,
    title VARCHAR(50),
    description VARCHAR(500),
    PRIMARY KEY(subreddit_id)
);

CREATE TABLE posts (
    post_id INT AUTO_INCREMENT,
    title VARCHAR(500),
    content TEXT,
    link VARCHAR(500),
    upvotes INT,
    user_id INT,
    subreddit_id INT,
    PRIMARY KEY(post_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE NO ACTION,
    FOREIGN KEY(subreddit_id) REFERENCES subreddits(subreddit_id) ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE comments (
    comment_id INT UNIQUE NOT NULL AUTO_INCREMENT,
    content TEXT,
    upvotes INT,
    user_id INT,
    post_id INT,
    PRIMARY KEY(comment_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(post_id) REFERENCES posts(post_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE profile_pics (
    user_id INT NOT NULL,
    content_type VARCHAR(255) NOT NULL,
    image BLOB NOT NULL,
    PRIMARY KEY(user_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- sample data to insert:

INSERT INTO Users (uname, password, email, about, country, totalUpvotes, profilePath, isAdmin, isBanned)
VALUES 
    ('Teddy2014', '12345', 'Teddy2014@example.com', 'Fell in the trap of COSC 360, welp!', 'Canada', 100, '/profiles/Teddy2014.jpg', 0, 0),
    ('Meerkat', '12345', 'Meerkat@example.com', 'I am an animal', 'Canada', 50, '/profiles/Meerkat.jpg', 0, 0),
    ('RedPanda', 'admin', 'RedPanda@example.com', 'I am the administrator', 'USA', 0, '/profiles/RedPanda.jpg', 1, 0),
    ('SeaOtter', '12345', 'SeaOtter@example.com', 'I am a banned user', 'Australia', 0, '/profiles/SeaOtter.jpg', 0, 1);

INSERT INTO Sublueddits (subid, subtitle, description)
VALUES 
    (1, 'OrangeCentral', 'We love Oranges'),
    (2, 'BananaCentral', 'We love Bananas'),
    (3, 'AppleCentral', 'We love Apples'),
    (4, 'COSC360Central', 'We hate this course');

INSERT INTO Posts (title, text, link, upvotes, uid, subid)
VALUES 
    ('I love Oranges', 'I love Oranges, they are so tasty', NULL, 10, 1, 1),
    ('I love Bananas', 'I love Bananas, they are so tasty', NULL, 5, 2, 2),
    ('I love Apples', 'I love Apples, they are so tasty', NULL, 2, 3, 3),
    ('I hate COSC 360', 'I hate COSC 360, it is ridiculous', NULL, 0, 4, 4);

-- Sample data for Comments table
INSERT INTO Comments (text, upvotes, uid, pid)
VALUES 
    ('I love Oranges too', 10, 1, 1),
    ('I love Bananas too', 5, 2, 2),
    ('I love Apples too', 2, 3, 3),
    ('I hate COSC 360 too', 0, 4, 4);




