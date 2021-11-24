CREATE TABLE IF NOT EXISTS agents
(
    id        INT(11)      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    full_name varchar(255) not null
) ENGINE = InnoDB;

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
