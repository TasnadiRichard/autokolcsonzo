
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE DATABASE IF NOT EXISTS `autokolcsonzo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `autokolcsonzo`;

CREATE TABLE `auto` (
  `autoid` int(10) UNSIGNED NOT NULL,
  `marka` varchar(60) NOT NULL,
  `tipus` varchar(30) DEFAULT NULL,
  `gyartasi_ido` date DEFAULT NULL,
  `kivitel` varchar(50) DEFAULT NULL,
  `megjegyzes` varchar(28) DEFAULT NULL,
  `nyilvantartasban` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



INSERT INTO `auto` (`autoid`, `marka`, `tipus`, `gyartasi_ido`, `kivitel`, `megjegyzes`, `nyilvantartasban`) VALUES
(1, 'Audi',  'A7 sportback', '2020-05-19', 'coupe', 'megjegyzés nincs', '2023-04-12'),
(2, 'BMW',  '520i', '2017-03-12', 'sedan', 'megjegyzés nincs', '2020-10-11'),
(3, 'Honda',  'NSX', '2017-09-12', 'sport', 'volt már sérülve', '2023-09-11'),
(4, 'Hyundai',  'Kona', '2022-01-24', 'SUV', 'megjegyzés nincs', '2023-02-10'),
(5, 'Kia', 'Stinger', '2020-07-02', 'sedan', 'volt már ezelőtt két tulajdonosa', '2021-03-16'),
(6, 'Maserati',  'Ghibli', '2018-09-16', 'coupe', 'megjegyzés nincs', '2023-08-10'),
(7, 'Mazda',  'CX-5', '2016-08-19', 'lépcsőshátú', 'megjegyzés nincs', '2023-05-10'),
(8, 'Mercedes', 'GLS 400', '2018-12-11', 'SUV', 'megjegyzés nincs', '2023-07-19'),
(9, 'Ford', 'Mustang Fastback', '2018-11-10', 'coupe', 'megjegyzés nincs', '2023-08-16'),
(10, 'Nissan',  'Qashqai', '2016-07-23', 'SUV', 'megjegyzés nincs', '2020-10-01'),
(11, 'Opel', 'Astra L', '2022-04-10', 'lépcsőshátú', 'van rajta kisebb sérülés', '2023-02-27'),
(12, 'Peugeot',  '408', '2021-11-28', 'SUV', 'megjegyzés nincs', '2022-04-10'),
(13, 'Renault', 'Captur', '2018-08-21', 'lépcsőshátú', 'megjegyzés nincs', '2020-11-26'),
(14, 'SSangYong',  'Rexton', '2022-12-14', 'SUV', 'megjegyzés nincs', '2023-02-15'),
(15, 'Volkswagen',  'Arteon', '2020-08-15', 'sedan', 'megjegyzés nincs', '2023-09-24');




CREATE TABLE `autokolcsonzes` (
  `autoid` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `autokolcsonzes` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `users` (
  `userid` int(10) UNSIGNED NOT NULL,
  `igazolvanyszam` varchar(8) NOT NULL,
  `autokolcsonzoszemely_neve` varchar(50) NOT NULL,
  `emailcim` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




ALTER TABLE `auto`
  ADD PRIMARY KEY (`autoid`),
  ADD UNIQUE KEY `marka` (`marka`);


ALTER TABLE `autokolcsonzes`
  ADD KEY `fk_autokolcsonzes_auto` (`autoid`),
  ADD KEY `fk_autokolcsonzes_user` (`userid`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `igazolvanyszam` (`igazolvanyszam`),
  ADD UNIQUE KEY `emailcim` (`emailcim`),
  ADD UNIQUE KEY `username` (`username`);




ALTER TABLE `auto`
  MODIFY `autoid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;


ALTER TABLE `users`
  MODIFY `userid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `autokolcsonzes`
  ADD CONSTRAINT `fk_autokolcsonzes_auto` FOREIGN KEY (`autoid`) REFERENCES `auto` (`autoid`),
  ADD CONSTRAINT `fk_autokolcsonzes_user` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

