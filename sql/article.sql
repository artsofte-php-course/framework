# CREATE TABLE  IF NOT EXISTS articles (
#     id INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
#     name varchar (255) not null,
#     body text
# ) ENGINE=InnoDB;
#
# INSERT INTO articles (name, body) VALUES ('Hello', 'Hello world long long page...');
# INSERT INTO articles (name, body) VALUES ('World', 'World hello extra long long page...');

CREATE TABLE IF NOT EXISTS agents
(
    id        INT(11)      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    full_name varchar(255) not null
) ENGINE = InnoDB;

# INSERT INTO agents (full_name) VALUE ('Peter Ivanovich Kuznetsov');   #1
# INSERT INTO agents (full_name) VALUE ('Andei Nikolaevich Trofimov');  #2
# INSERT INTO agents (full_name) VALUE ('Anatolii Nikitevich Lazarev'); #3

# drop table apartments_sells;

CREATE TABLE IF NOT EXISTS apartments_sells
(
    agent_id         INT(11)      NOT NULL,

    sum              INT(11)      NOT NULL,
    contract_number  varchar(255) not null,
    apartment_number INT(11)      NOT NULL,
    living_complex   varchar(255) not null,
    FOREIGN KEY (agent_id) REFERENCES agents (id),
    PRIMARY KEY (apartment_number, living_complex)
) ENGINE = InnoDB;

# INSERT INTO apartments_sells (agent_id, sum, contract_number, apartment_number, living_complex)
# VALUES (1, 125000, 101, 228, 'Bebra-town');
#
# INSERT INTO apartments_sells (agent_id, sum, contract_number, apartment_number, living_complex)
# VALUES (1, 14800, 102, 789, 'Golden-wind');
#
# INSERT INTO apartments_sells (agent_id, sum, contract_number, apartment_number, living_complex)
# VALUES (1, 59000, 103, 139, 'Jmihograd');
#
# INSERT INTO apartments_sells (agent_id, sum, contract_number, apartment_number, living_complex)
# VALUES (2, 75890, 201, 78, 'Bebra-town');
#
# INSERT INTO apartments_sells (agent_id, sum, contract_number, apartment_number, living_complex)
# VALUES (2, 65483, 202, 98, 'Jmihograd');
#
# INSERT INTO apartments_sells (agent_id, sum, contract_number, apartment_number, living_complex)
# VALUES (3, 69492, 301, 54, 'Golden-wind');

CREATE TABLE IF NOT EXISTS contracts
(
    number          varchar(255) primary key,
    agent_name      varchar(255),
    living_complex  varchar(255),
    award_type      varchar(255) check (award_type = 'fix' or award_type = 'percent'),
    award_size      DECIMAL(11),
    expiration_date datetime,
    sign_date       datetime
) ENGINE = InnoDB;

# insert into contracts (number, agent_name, living_complex, award_type, award_size, expiration_date, sign_date)
# values (9827439, 'Grigoriy Mironovich Karpov', 'Three-leaf Clover', 'fix', 120000, '2021-11-23', '2022-11-25');
