CREATE OR REPLACE PROCEDURE proce_notes(
    id_note_p IN NOTAS.id%TYPE DEFAULT NULL,
    title_note_p IN NOTAS.title%TYPE DEFAULT NULL,
    content_note_p IN NOTAS.content%TYPE DEFAULT NULL,
    user_id_p IN NOTAS.id_user%TYPE DEFAULT NULL,
    mensaje OUT VARCHAR2,
    mod_est CHAR
)
IS
BEGIN
    LOCK TABLE notas IN ROW EXCLUSIVE MODE;
    IF mod_est = 'I' THEN
        INSERT INTO NOTAS(TITLE,CONTENT,ID_USER) VALUES(title_note_p, content_note_p, user_id_p);
        mensaje := 'Registro insertado correctamente';
        COMMIT;
    ELSIF mod_est = 'U' THEN
        UPDATE NOTAS SET title = title_note_p, content = content_note_p WHERE id = id_note_p;
        mensaje := 'Registro actualizado correctamente';
        COMMIT;
    ELSIF mod_est = 'D' THEN
        DELETE FROM NOTAS WHERE id = id_note_p;
        mensaje := 'Registro eliminado correctamente';
        COMMIT;
    ELSE
        RAISE_APPLICATION_ERROR(-20001, 'Error en el parametro mod_est');
    END IF;
EXCEPTION
    WHEN OTHERS THEN
        ROLLBACK;
END;