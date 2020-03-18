CREATE DATABASE IF NOT EXISTS laravel_master;

USE laravel_master;


CREATE TABLE IF NOT EXISTS users (
    id              int(255) auto_increment not null,
    role            varchar(20) not null,
    name            varchar(100) not null,
    surname         varchar(100) not null,
    nick            varchar(255) not null,
    email           varchar(255) not null,
    password        varchar(255) not null,
    image           varchar (255),
    created_at      datetime,
    updated_at      datetime,
    remember_token  varchar(255),
    
    CONSTRAINT pk_users PRIMARY KEY (id)


)ENGINE=InnoDB;

INSERT INTO users VALUES(NULL, 'user', 'Stefano', 'Gomez','ShadowCSM', 'stefano@stefano.com', 'ghostsniper45', null, CURTIME(), CURTIME(), null); 

INSERT INTO users VALUES(NULL, 'user', 'Carlo', 'Coloma','CarloCSM', 'carlo@carlo.com', 'carlo1234', null, CURTIME(), CURTIME(), null); 
INSERT INTO users VALUES(NULL, 'user', 'Manolo', 'Garcia','ManoloCSM', 'manolo@manolo.com', 'manolo123', null, CURTIME(), CURTIME(), null); 



CREATE TABLE IF NOT EXISTS images (
    id              int(255) auto_increment not null,
    user_id         int(255) not null,
    image_path      varchar(255),
    description     text,
    created_at      datetime,
    updated_at      datetime,
    
    CONSTRAINT pk_images PRIMARY KEY (id),
    CONSTRAINT fk_images_users FOREIGN KEY (user_id) REFERENCES users (id)


)ENGINE=InnoDB;

INSERT INTO images VALUES (NULL, 1, 'test.jpg', 'descripcion de prueba',  CURTIME(), CURTIME());
INSERT INTO images VALUES (NULL, 2, 'playa.jpg', 'descripcion de prueba 2',  CURTIME(), CURTIME());
INSERT INTO images VALUES (NULL, 3, 'arena.jpg', 'descripcion de prueba 3',  CURTIME(), CURTIME());
INSERT INTO images VALUES (NULL, 1, 'arbol.jpg', 'descripcion de prueba 4',  CURTIME(), CURTIME());
INSERT INTO images VALUES (NULL, 2, 'arena.jpg', 'descripcion de prueba 5',  CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS comments (
    id              int(255) auto_increment not null,
    user_id         int(255) not null,
    image_id        int(255),
    content         text,
    created_at      datetime,
    updated_at      datetime,

    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_users FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY (image_id) REFERENCES images(id)

)ENGINE=InnoDB;

INSERT INTO comments VALUES (NULL, 1, 1, 'Esto es un comentario de prueba',  CURTIME(), CURTIME());
INSERT INTO comments VALUES (NULL, 2, 2, 'Nueva foto de playa',  CURTIME(), CURTIME());
INSERT INTO comments VALUES (NULL, 2, 3, 'Arena nueva :0',  CURTIME(), CURTIME());
INSERT INTO comments VALUES (NULL, 3, 4, 'Mira este arbol :)',  CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS likes (
    id              int(255) auto_increment not null,
    user_id         int(255) not null,
    image_id        int(255) not null, 
    created_at      datetime,
    updated_at      datetime,

    CONSTRAINT pk_likes PRIMARY KEY(id),
    CONSTRAINT fk_likes_users FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY (image_id) REFERENCES images(id)

)ENGINE=InnoDB;

INSERT INTO likes VALUES (NULL, 1, 3,CURTIME(), CURTIME());
INSERT INTO likes VALUES (NULL, 1, 2,CURTIME(), CURTIME());
INSERT INTO likes VALUES (NULL, 3, 2,CURTIME(), CURTIME());
INSERT INTO likes VALUES (NULL, 2, 1,CURTIME(), CURTIME());