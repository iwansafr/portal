SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kelas` (`id`, `title`) VALUES
(1, 'X RPL 1'),
(2, 'X RPL 2'),
(3, 'X AKL 1'),
(4, 'X AKL 2'),
(5, 'X OTKP 1'),
(6, 'X OTKP 2'),
(7, 'X OTKP 3'),
(8, 'X BDP 1'),
(9, 'X BDP 2'),
(10, 'X TBSM 1'),
(11, 'X TBSM 2'),
(12, 'XI RPL 1'),
(13, 'XI RPL 2'),
(14, 'XI AKL 1'),
(16, 'XI AKL 2'),
(17, 'XI OTKP 1'),
(18, 'XI OTKP 2'),
(19, 'XI OTKP 3'),
(20, 'XI TBSM 1'),
(21, 'XI TBSM 2'),
(22, 'XI BDP 1'),
(23, 'XI BDP 2'),
(24, 'XII RPL 1'),
(25, 'XII RPL 2'),
(26, 'XII PM 1'),
(27, 'XII PM 2'),
(28, 'XII AP 1'),
(29, 'XII AP 2'),
(30, 'XII AP 3'),
(31, 'XII TSM'),
(33, 'SEMUA KELAS X');

DROP TABLE IF EXISTS `mapel`;
CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `color` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `mapel` (`id`, `kelas_id`, `title`, `kode`, `color`, `link`, `date`, `start`, `end`, `status`) VALUES
(2, 33, 'mtk', 'mtkx', '#164dc1', 'https://www.esoftgreat.com', '2019-03-03', '20:00:00', '21:00:00', 1),
(3, 33, 'SEJARAH', 'sj', '#45c12e', 'https://www.esoftgreat.com', '2019-03-03', '20:00:00', '21:00:00', 1);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `username`, `password`, `created`, `updated`) VALUES
(1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', '2019-03-03 09:36:39', '2019-03-03 09:36:39'),
(2, 'eskasaba', '3bf1067fc6f6efb41336cd7f29147660', '2019-03-03 12:26:20', '2019-03-03 12:26:20');


ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
