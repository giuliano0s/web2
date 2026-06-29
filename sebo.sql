-- Sebo online: schema e dados dummy
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- cadastros simples

CREATE TABLE `usuario` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(120) NOT NULL,
  `email` VARCHAR(160) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `categoria` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(80) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- um-para-muitos: categoria 1..n produto

CREATE TABLE `produto` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `titulo` VARCHAR(180) NOT NULL,
  `autor` VARCHAR(120) NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `categoria_id` INT NOT NULL,
  FOREIGN KEY (`categoria_id`) REFERENCES `categoria`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tag` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(60) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- muitos-para-muitos

CREATE TABLE `produto_tag` (
  `produto_id` INT NOT NULL,
  `tag_id` INT NOT NULL,
  PRIMARY KEY (`produto_id`, `tag_id`),
  FOREIGN KEY (`produto_id`) REFERENCES `produto`(`id`),
  FOREIGN KEY (`tag_id`) REFERENCES `tag`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `carrinho` (
  `usuario_id` INT NOT NULL,
  `produto_id` INT NOT NULL,
  `quantidade` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`usuario_id`, `produto_id`),
  FOREIGN KEY (`usuario_id`) REFERENCES `usuario`(`id`),
  FOREIGN KEY (`produto_id`) REFERENCES `produto`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- dados dummy

INSERT INTO `usuario` (`nome`, `email`, `senha`) VALUES
('Giuliano Souza', 'giuliano@sebo.com', '$2y$10$iYQHH1EI9nOS6h2KZwy5PuByCmIPGD52whSRCH69OtqC8cEvyJhLG');

INSERT INTO `categoria` (`nome`) VALUES
('Romance'),
('Ficção Científica'),
('Técnico');

INSERT INTO `produto` (`titulo`, `autor`, `preco`, `categoria_id`) VALUES
('Dom Casmurro', 'Machado de Assis', 24.90, 1),
('Memórias Póstumas de Brás Cubas', 'Machado de Assis', 22.50, 1),
('Duna', 'Frank Herbert', 49.90, 2),
('Neuromancer', 'William Gibson', 38.00, 2),
('Código Limpo', 'Robert C. Martin', 79.90, 3);

INSERT INTO `tag` (`nome`) VALUES
('clássico'),
('nacional'),
('distopia'),
('programação');

INSERT INTO `produto_tag` (`produto_id`, `tag_id`) VALUES
(1, 1), (1, 2),
(2, 1), (2, 2),
(3, 3),
(4, 3),
(5, 4);

INSERT INTO `carrinho` (`usuario_id`, `produto_id`, `quantidade`) VALUES
(1, 3, 1);

SET FOREIGN_KEY_CHECKS = 1;
