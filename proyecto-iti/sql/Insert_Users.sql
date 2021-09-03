USE siscoin_unit;

INSERT INTO usuario (
    grupo_user, mail_user, pass_user,
    nom_comp_user, fk_grupo
) VALUES (
    "Director", "director@gmail.com",
    "$2y$10$7mrHFVxutyrBGlOEpDAtXO6HBasVgdEjUQJGsCzZDBhVG/mj7YaoG",
    "Director Prueba", 1
),
(
    "Informática", "informatica@gmail.com",
    "$2y$10$gEAGR575J8j486RN/i5RAeDcznz8Uf4Ne323Vr/kVCS..gsWq5Key",
    "Informática Prueba", 2
),
(
    "Subdirección A", "subA@gmail.com",
    "$2y$10$rl1L6K9bw279xebuTA7C4uRFayq.HBvkfOp3kzZdY0cPrbGiPY3mu",
    "Subdirección A Prueba", 3
),
(
    "Subdirección B", "subB@gmail.com",
    "$2y$10$7O1BKIBCBAnLDbt7kK8z2OFAJjAKsjuyPu7mdXIZgAMUfzAv/jahy",
    "Subdirección B Prueba", 4
),
(
    "Oficina", "oficina@gmail.com",
    "$2y$10$nKpCongAWAuOksAimvdz3uLN/GfIESd5HDVscvhamgi2POovQBnl6",
    "Oficina Prueba", 5
),
(
    "Compras", "compras@gmail.com",
    "$2y$10$cOzj1yhAEMHoExDEvIqHxe.KgZPA7zwOVBk7W1wP9WHa5/SU5Xmiq",
    "Compras Prueba", 6
),
(
    "Auditoría", "auditoria@gmail.com",
    "$2y$10$ZnokG31469ORzcdk78/2w.8drgkrLp9zJhPBhzlupM66cxWCTupaG",
    "Auditoría Prueba", 7
);