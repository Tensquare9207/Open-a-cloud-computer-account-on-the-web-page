CREATE TABLE settings  (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    config TEXT NOT NULL,
    status TEXT NULL
);

insert into settings (name, config, status) values ("logo","/img/lt.png", null);
insert into settings (name, config, status) values ("icon","/img/icon.png", null);
insert into settings (name, config, status) values ("webname","蓝天新世界", null);
insert into settings (name, config, status) values ("email",'{"host": "smtp.yeah.net","username": "tensquare@yeah.net","password": "HGQFDDBFTKBNIIDQ","port": 465,"secure": "ssl","mail": "tensquare@yeah.net","name": "蓝天新世界！","topic":"注册蓝天新世界"}', null);
insert into settings (name, config, status) values ("key","114514", null);
insert into settings (name, config, status) values ("version","1.0", null);
insert into settings (name, config, status) values ("type","yw", null);
insert into settings (name, config, status) values ("typex","授权版", null);
insert into settings (name, config, status) values ("wxpay","{'apiurl': 'http://pay.www.com/','pid': '1000','key': 'WWc3Z2jkK7jhNGPALcGKjHLPK47wRK85'}", '1');
insert into settings (name, config, status) values ("alipay","{'apiurl': 'http://pay.www.com/','pid': '1000','key': 'WWc3Z2jkK7jhNGPALcGKjHLPK47wRK85'}", '1');
insert into settings (name, config, status) values ("QQpay","{'apiurl': 'http://pay.www.com/','pid': '1000','key': 'WWc3Z2jkK7jhNGPALcGKjHLPK47wRK85'}", '1');
insert into settings (name, config, status) values ("notify","Hello，Welcome to use our service！", '0');

