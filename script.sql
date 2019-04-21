USE intuuchina;

CREATE TABLE users (
	id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    surnames VARCHAR(255),
    email VARCHAR(255),
    nacionality VARCHAR(255) NOT NULL,
    current_password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP,
    PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO users (name, surnames, email, nacionality, current_password) VALUES ('Steve', 'Stifler', 'stifmeister@gmail.com', 'American', '1234');