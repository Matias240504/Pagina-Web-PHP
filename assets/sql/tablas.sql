create table usuarios(
id_usuario int auto_increment primary key,
usuario varchar(100) not null unique,
password varchar(255) not null,
nombre varchar(50) not null,
apellidos varchar(50) not null,
telefono varchar(15)
);

create table tareas(
id_tarea int auto_increment primary key,
id_usuario int not null,
nombre_tarea varchar(50) not null,
descripcion_tarea varchar(500),
estado_tarea ENUM('pendiente', 'en_progreso', 'completada') DEFAULT 'pendiente' not null,
foreign key (id_usuario) references usuarios(id_usuario)
);

create table informes(
id_informes INT AUTO_INCREMENT PRIMARY KEY,
id_usuario INT not null,
nombre_informe VARCHAR(255) NOT NULL,
fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
estado_informe ENUM('completed', 'incomplete') not null,
foreign key (id_usuario) references usuarios(id_usuario)
);