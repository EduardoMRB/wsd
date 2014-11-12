--
-- Database: `apptest`
--

CREATE TABLE IF NOT EXISTS `apartamento` (
  `id_apartamento` int(11) NOT NULL AUTO_INCREMENT,
  `morador` varchar(45) NOT NULL,
  `numero` int(11) NOT NULL,
  `saldo` float NOT NULL,
  `meses_devedores` varchar(45) NOT NULL,
  PRIMARY KEY (`id_apartamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

CREATE TABLE IF NOT EXISTS `mes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `vencimento` varchar(45) NOT NULL,
  `valorCondominio` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


CREATE TABLE IF NOT EXISTS `mes_despesa` (
  `idDespesa` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text NOT NULL,
  `valor` varchar(45) NOT NULL,
  `idMesRef` int(11) NOT NULL,
  PRIMARY KEY (`idDespesa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


