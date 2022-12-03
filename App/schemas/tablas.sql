CREATE TABLE notas(
    id NUMBER GENERATED BY DEFAULT AS IDENTITY,
    title VARCHAR2(100) NOT NULL,
    content VARCHAR2(1000) NOT NULL,
    user_id NUMBER NOT NULL
);
ALTER TABLE notas ADD CONSTRAINT notes_pk PRIMARY KEY (id);
ALTER TABLE notas ADD CONSTRAINT notes_user_fk FOREIGN KEY (user_id) REFERENCES users(id);

CREATE TABLE USERS(
    id NUMBER GENERATED BY DEFAULT AS IDENTITY,
    username VARCHAR2(100) NOT NULL,
    email VARCHAR2(100) NOT NULL,
    password VARCHAR2(100) NOT NULL,
    idrol NUMBER NOT NULL
);

ALTER TABLE USERS ADD CONSTRAINT users_pk PRIMARY KEY (id);
ALTER TABLE USERS ADD CONSTRAINT users_rol_fk FOREIGN KEY (idrol) REFERENCES rol(idrol);


CREATE TABLE ROL(
    IDROL NUMBER GENERATED BY DEFAULT AS IDENTITY,
    NOMBREROL VARCHAR2(100) NOT NULL
);

ALTER TABLE ROL ADD CONSTRAINT rol_pk PRIMARY KEY (idrol);

