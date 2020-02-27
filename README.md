# Social-NoteBook
 note management web application

 ## DDBB
  name: social_notebook
  
     Tables:

        users:
            CREATE TABLE `users` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,
            `mail` varchar(255) NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8

        notes:
            CREATE TABLE `notes` (
            `id` bigint(6) NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `body` text NOT NULL,
            `date` datetime DEFAULT current_timestamp(),
            `id_user` bigint(6) NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8

        friends:
            CREATE TABLE `friends` (
            `id` bigint(6) NOT NULL AUTO_INCREMENT,
            `id_user` bigint(6) NOT NULL,
            `id_friend` bigint(6) NOT NULL,
            `are_friend` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8

        shared_notes:
            CREATE TABLE `shared_notes` (
            `id` bigint(6) NOT NULL AUTO_INCREMENT,
            `id_note` bigint(6) NOT NULL,
            `id_friend` bigint(6) NOT NULL,
            `read_permission` tinyint(1) NOT NULL DEFAULT 0,
            `write_permission` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8

## Licenses


Autor: Miguel Ángel Gil Martín (MAGMa)
Esta obra está licenciada bajo la Licencia Creative Commons Atribución-CompartirIgual 4.0 
Internacional. Para ver una copia de esta licencia, 
visite http://creativecommons.org/licenses/by-sa/4.0/.

## Webside
http://social-notebook.mag-ma.online


