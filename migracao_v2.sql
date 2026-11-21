-- Atualiza um banco criado com a versão antiga do banco.sql.
-- Rode apenas uma vez, se você já tinha o banco "digas" antes desta versão.
USE digas;

-- Administrador passa a ser definido no banco (antes era um e-mail fixo no código)
ALTER TABLE usuarios ADD COLUMN is_admin TINYINT(1) NOT NULL DEFAULT 0;
UPDATE usuarios SET is_admin = 1 WHERE email = 'admin@as.com';

-- Publicações passam a guardar o e-mail do autor (o nome não é único)
ALTER TABLE publicacoes ADD COLUMN usuario_email VARCHAR(100) DEFAULT NULL AFTER autor;
ALTER TABLE publicacoes ADD INDEX (usuario_email);
UPDATE publicacoes p
JOIN usuarios u ON u.nome = p.autor
SET p.usuario_email = u.email
WHERE p.usuario_email IS NULL;

ALTER TABLE comentarios ADD INDEX (publicacao_id);
