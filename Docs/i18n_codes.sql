
CREATE TABLE i18n_codes (
	id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	acronym CHAR(6) NOT NULL,
	data_type CHAR(25) NOT NULL,
    language CHAR(6) NOT NULL,
	code CHAR(30) NOT NULL,
	acronym_code VARCHAR(36) NOT NULL,
	message VARCHAR (250) NOT NULL,
	deleted ENUM('Y', 'N') DEFAULT 'N',
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) Engine=InnoDB


id, acronym, data_type, language, code, acronym_code, message, deleted, created_at, updated_at