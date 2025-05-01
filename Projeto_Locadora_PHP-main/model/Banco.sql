create database if not exists Banco;
use Banco;

create table Cliente ( 
						cpf varchar(100) primary key not null,
						nome varchar(100) not null,
						senha varchar(100) not null,
						email varchar(100) not null,
						telefone varchar(100));

insert into Cliente values("000.000.000-00", "admin", "admin12345", "admin@gmail.com", "0000");
#dados para entrar como admin no login


create table Carro(
					modelo varchar(100),
					quantidade int not null,
					placa varchar(100) primary key not null,
					status int not null, # 0 é indisponivel, 1 é disponivel
					data_aquisicao date not null,
					foto MEDIUMBLOB,
					preco double); #eu mudei aqui pra long blob mas nao testei


create table locacao( #mudar para locação
						cpf_cliente varchar(100),
						placa_carro varchar(100), 
						datainicio date,
						primary key(placa_carro,cpf_cliente,datainicio), #As datas são primary key , pois as pessoas podem alugar o mesmo carro em datas diferentes
						foreign key(cpf_cliente) references Cliente(cpf),
						foreign key(placa_carro) references Carro(placa)

						);

create table historico(
						placa_dev varchar(100),
						cpf_dev varchar(100), 
						datainicio date,
						datafim date,
						preco double,
						primary key(placa_dev,cpf_dev,datainicio,datafim), #As datas são primary key , pois as pessoas podem alugar o mesmo carro em datas diferentes
						foreign key(cpf_dev) references Cliente(cpf)
);
DELIMITER //
create trigger ChangeStatus before update on Carro for each row
begin 
   if new.quantidade = 0 then set	new.status=0;
   end if;
end //
DELIMITER ;


set global max_allowed_packet=43554432;
->close();
}

