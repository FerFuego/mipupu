# Mi pupú


<!-- CREATE TABLE `PAGOS` (
  `Id_Pago` INT NOT NULL AUTO_INCREMENT,
  `Id_Pedido` INT NOT NULL,
  `MP_Payment_ID` VARCHAR(50) NOT NULL,         -- ID real del pago en MercadoPago
  `Status` VARCHAR(20) NOT NULL,                -- approved / pending / rejected
  `Metodo` VARCHAR(50) DEFAULT NULL,            -- visa / mastercard / debit_card / account_money
  `Monto` DECIMAL(12,2) NOT NULL,               -- monto total del pago
  `Moneda` VARCHAR(10) NOT NULL DEFAULT 'ARS',  -- ARS normalmente
  `Cuotas` INT DEFAULT NULL,                    -- número de cuotas
  `Fecha` DATETIME NOT NULL,                    -- fecha del evento
  `Raw` TEXT DEFAULT NULL,                      -- JSON completo para auditoría
  PRIMARY KEY (`Id_Pago`),
  KEY `Id_Pedido` (`Id_Pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; -->
