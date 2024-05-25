    DROP DATABASE IF EXISTS `login-page`;
    CREATE DATABASE IF NOT EXISTS `login-page`;
    USE `login-page`;

    CREATE TABLE IF NOT EXISTS `users` (
      `id` int NOT NULL AUTO_INCREMENT, 
      `nome` varchar(100) DEFAULT NULL, 
      `email` varchar(50) DEFAULT NULL, 
      `senha` varchar(600) DEFAULT NULL, 
      PRIMARY KEY (`id`) 
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

    CREATE TABLE IF NOT EXISTS `dados_grafico` (
      `id_dados` INT NOT NULL AUTO_INCREMENT,
      `id_usuario` INT NOT NULL,
      `entradas` DECIMAL(10,2) NOT NULL, 
      `saidas` DECIMAL(10,2) NOT NULL, 
      `poupanca` DECIMAL(10,2) NOT NULL, 
      PRIMARY KEY (`id_dados`),
      FOREIGN KEY (`id_usuario`) REFERENCES `users`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

    CREATE TABLE IF NOT EXISTS `historico_transacoes` (
      `id_transacao` INT NOT NULL AUTO_INCREMENT,
      `id_usuario` INT NOT NULL,
      `descricao` VARCHAR(255) NOT NULL,
      `valor` DECIMAL(10,2) NOT NULL,
      `tipo` VARCHAR(20) NOT NULL,
      PRIMARY KEY (`id_transacao`),
      FOREIGN KEY (`id_usuario`) REFERENCES `users`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

    CREATE TABLE IF NOT EXISTS `saldos` (
      `id_saldo` INT NOT NULL AUTO_INCREMENT, 
      `id_usuario` INT NOT NULL, 
      `saldo_total` DECIMAL(10,2) NOT NULL,
      `saldo_caixa` DECIMAL(10,2) NOT NULL,
      `poupanca` DECIMAL(10,2) NOT NULL,
      PRIMARY KEY (`id_saldo`),
      FOREIGN KEY (`id_usuario`) REFERENCES `users`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
