-- pay_orders.sql
CREATE TABLE IF NOT EXISTS `pay_orders` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `order_no`    VARCHAR(64)   NULL COMMENT '商户订单号 out_trade_no',
  `trade_no`    VARCHAR(64)   NULL COMMENT '易支付交易号',
  `name`        VARCHAR(128)  NULL COMMENT '商品名称',
  `money`       DECIMAL(10,2)  NULL COMMENT '支付金额',
  `token`       VARCHAR(64)   NULL COMMENT '用户 token',
  `status`      TINYINT(1)    NULL DEFAULT 0 COMMENT '0=未支付,1=已支付,2=异常',
  `pay_time`    DATETIME     NULL COMMENT '支付完成时间',
  `create_time` DATETIME      NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_order_no` (`order_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='易支付订单表';