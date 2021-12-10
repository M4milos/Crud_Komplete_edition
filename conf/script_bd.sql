create schema `bdi`;

CREATE TABLE bdi.produto (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_qnt` int DEFAULT NULL,
  `produto_type` varchar(45) default null,
  `produto_price` int default null,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

INSERT INTO bdi.produto (produto_qnt, produto_type, produto_price)
VALUES ("22", "RTX 3090", "9569");

INSERT INTO bdi.produto (produto_qnt, produto_type, produto_price)
VALUES ("100", "INTEL core i9 11900k", "6323");

INSERT INTO bdi.produto (produto_qnt, produto_type, produto_price)
VALUES ("283", "INTEL celeron dual core", "303");

INSERT INTO bdi.produto (produto_qnt, produto_type, produto_price)
VALUES ("189", "RYZEN 5 3600", "1540");

INSERT INTO bdi.produto (produto_qnt, produto_type, produto_price)
VALUES ("991", "GABINETE GAMER", "320");

CREATE TABLE bdi.cliente (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(45) default null,
  `usuario` varchar(45) default null,
  `senha` varchar(45) default null unique,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

INSERT INTO bdi.cliente (nome, email, usuario, senha )
VALUES ("João", "nseiteste@gmail.com", "joaozinho123", "joao1234");

INSERT INTO bdi.cliente (nome, email, usuario, senha )
VALUES ("Pedro", "pedrinho@gmail.com", "pedrinho1234", "pedroxyz123");

INSERT INTO bdi.cliente (nome, email, usuario, senha )
VALUES ("Jeremias", "jere.mias@gmail.com", "jeremias1234", "Jere.mias");

INSERT INTO bdi.cliente (nome, email, usuario, senha )
VALUES ("Ana", "Ana.linda@gmail.com", "aninhaOlinda", "AnaS2");

INSERT INTO bdi.cliente (nome, email, usuario, senha )
VALUES ("Bianca", "Biancanseioq@gmail.com", "Bibs", "Bianca!123ç");


CREATE TABLE bdi.venda (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagamento` DATE DEFAULT NULL,
  `vencimento` DATE default null,
  `venda` DATE default null,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

INSERT INTO bdi.venda (pagamento, vencimento, venda)
VALUES ("2018-08-21", "2018-09-01", "2018-06-30");

INSERT INTO bdi.venda (pagamento, vencimento, venda)
VALUES ("2019-04-02", "2019-07-02", "2019-04-01");

INSERT INTO bdi.venda (pagamento, vencimento, venda)
VALUES ("2018-12-09", "2019-03-21", "2018-12-07");

INSERT INTO bdi.venda (pagamento, vencimento, venda)
VALUES ("2020-09-21", "2020-12-1", "2020-08-12");

INSERT INTO bdi.venda (pagamento, vencimento, venda)
VALUES ("2021-09-08", "2021-12-03", "2021-08-12");
