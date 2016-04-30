################################ Login ############################
SELECT user, name_user, pass, type FROM users WHERE user = 'admin'

############################### Validar usuario y email ########################
SELECT user FROM users WHERE user = 'admin'
SELECT user FROM email WHERE user = 'g_rodriguez@outlook.es'

############################### Guardar usuario ################################
INSERT INTO users values(default, '$user', '$name_user', '$ap_user', '$passHash', '$email','$rango', '$salt', current_timestamp)

############################### Todos los Usuarios #############################
SELECT c.idchanges, c.type, c.label, c.date, u.user FROM changes as c
INNER JOIN users as u on c.users_idusers = u.idusers