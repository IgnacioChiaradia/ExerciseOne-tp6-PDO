DROP DATABASE IF EXISTS dbcellphones;
CREATE DATABASE dbcellphones;

use dbcellphones;

CREATE TABLE cellphones
(
  id_cellphone INT AUTO_INCREMENT,
  code INT,
  brand VARCHAR (50),
  model VARCHAR (50),
  price INT,

  CONSTRAINT pk_id_cellphone PRIMARY KEY (id_cellphone),
  CONSTRAINT uniq_code UNIQUE (code)
);