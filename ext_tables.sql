
# Small basic entities
CREATE TABLE tx_projectorganizer_domain_model_status (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  title VARCHAR(255) NOT NULL DEFAULT '',

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_domain_model_validation_state (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  status INT(11) NOT NULL DEFAULT '0',
  tstamp int(11) unsigned DEFAULT '0' NOT NULL,

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_domain_model_topic (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  title VARCHAR(255) NOT NULL DEFAULT '',

  institutions INT(11) UNSIGNED NOT NULL DEFAULT '0',
  projects INT(11) UNSIGNED NOT NULL DEFAULT '0',
  persons INT(11) UNSIGNED NOT NULL DEFAULT '0',

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_domain_model_region (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  title VARCHAR(255) NOT NULL DEFAULT '',

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_domain_model_wskelement (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  title VARCHAR(255) NOT NULL DEFAULT '',

  institutions INT(11) NOT NULL DEFAULT '0',
  persons INT(11) NOT NULL DEFAULT '0',
  projects INT(11) NOT NULL DEFAULT '0',

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_domain_model_institution_type (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  title VARCHAR(255) NOT NULL DEFAULT '',
  institution_type VARCHAR(255) NOT NULL DEFAULT '',
  location VARCHAR(255) NOT NULL DEFAULT '',
  country VARCHAR(255) NOT NULL DEFAULT '',
  wsk_element VARCHAR(255),
  topic VARCHAR(255),

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_domain_model_publication_type (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  title VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (uid)
);

#main entities
CREATE TABLE tx_projectorganizer_domain_model_researchprogram (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  title VARCHAR(255) NOT NULL DEFAULT '',
  supporting VARCHAR(255),
  link VARCHAR(255),
  runtime VARCHAR(255),
  description TEXT,

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_domain_model_project (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  orig INT(11),
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  show_in_map tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hypos tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  title VARCHAR(255) NOT NULL DEFAULT '',
  description TEXT,
  volume VARCHAR(255),
  overall_volume VARCHAR(255),
  location VARCHAR(255),
  link VARCHAR(255),
  runtime_start VARCHAR(255),
  runtime_end VARCHAR(255),
  place VARCHAR(255),
  contact_email VARCHAR(255),
  validation_state INT(1) DEFAULT '0',
  password_hash VARCHAR(255) NOT NULL DEFAULT '',

  status VARCHAR(255),
  wsk_element VARCHAR(255),
  region VARCHAR(255),
  researchprogram VARCHAR(255),
  contact_person VARCHAR(255),
  institution INT(11) NOT NULL DEFAULT '0',
  
  publications INT(11) NOT NULL DEFAULT '0',
  persons INT(11) NOT NULL DEFAULT '0',
  topics INT(11) NOT NULL DEFAULT '0',

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_domain_model_person (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  title VARCHAR(255) NOT NULL DEFAULT '',
  specialist_field VARCHAR(255),
  entry_date VARCHAR(255) NOT NULL DEFAULT '',
  place VARCHAR(255),
  e_mail VARCHAR(255),
  description TEXT,

  wsk_element VARCHAR(255),

  projects INT(11) UNSIGNED NOT NULL DEFAULT '0',
  institutions INT(11) UNSIGNED NOT NULL DEFAULT '0',
  publications INT(11) UNSIGNED NOT NULL DEFAULT '0',
  topics INT(11) UNSIGNED NOT NULL DEFAULT '0',

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_domain_model_publication (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  title VARCHAR(255) NOT NULL DEFAULT '',
  author VARCHAR(255) NOT NULL DEFAULT '',
  published VARCHAR(255) NOT NULL DEFAULT '',

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_domain_model_institution (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  title VARCHAR(255) NOT NULL DEFAULT '',
  institution_type VARCHAR(255) NOT NULL DEFAULT '',
  location VARCHAR(255) NOT NULL DEFAULT '',
  country VARCHAR(255) NOT NULL DEFAULT '',
  wsk_element VARCHAR(255),
  topic VARCHAR(255),

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_domain_model_engagement (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  position VARCHAR(255) NOT NULL DEFAULT '',
  start_date INT(11),
  end_date INT(11),

  person_uid INT(11) NOT NULL NULL DEFAULT '0',
  person_sorting INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  institution_uid INT(11) NOT NULL DEFAULT '0',
  institution_sorting INT(11) UNSIGNED DEFAULT '0' NOT NULL,

  PRIMARY KEY (uid)
);

# n:m relations
CREATE TABLE tx_projectorganizer_mm_project_institution (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  sorting INT(11) DEFAULT '0' NOT NULL,
  sorting_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  uid_local INT(11) UNSIGNED NOT NULL DEFAULT '0',
  uid_foreign INT(11) UNSIGNED NOT NULL DEFAULT '0',

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_mm_project_publication (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  uid_local INT(11) NOT NULL DEFAULT '0',
  sorting INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  uid_foreign INT(11) UNSIGNED NULL DEFAULT '0',
  sorting_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,

  PRIMARY KEY (uid)
);

# n:m relations
CREATE TABLE tx_projectorganizer_mm_project_persons (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  uid_local INT(11) NOT NULL DEFAULT '0',
  sorting INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  uid_foreign INT(11) NOT NULL DEFAULT '0',
  sorting_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_mm_project_topic (
  uid INT(11) NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  uid_local INT(11) NOT NULL DEFAULT '0',
  sorting INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  uid_foreign INT(11) NOT NULL DEFAULT '0',
  sorting_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_mm_person_publication (
  uid INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  authorship VARCHAR(255) NOT NULL DEFAULT '',

  uid_local INT(11) UNSIGNED NOT NULL DEFAULT '0',
  sorting INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  uid_foreign INT(11) UNSIGNED NOT NULL DEFAULT '0',
  sorting_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_mm_person_institution (
  uid INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  position VARCHAR(255) NOT NULL DEFAULT '',
  start_date INT(11) UNSIGNED,
  end_date INT(11) UNSIGNED,

  uid_local INT(11) UNSIGNED NOT NULL DEFAULT '0',
  sorting INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  uid_foreign INT(11) UNSIGNED NOT NULL DEFAULT '0',
  sorting_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_mm_person_topic (
  uid INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  uid_local INT(11) UNSIGNED NOT NULL DEFAULT '0',
  sorting INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  uid_foreign INT(11) UNSIGNED NOT NULL DEFAULT '0',
  sorting_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,

  PRIMARY KEY (uid)
);

CREATE TABLE tx_projectorganizer_mm_institution_topic (
  uid INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  pid INT(11) NOT NULL DEFAULT '0',

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l18n_parent int(11) DEFAULT '0' NOT NULL,
  access_group int(11) DEFAULT '0' NOT NULL,

  uid_local INT(11) UNSIGNED NOT NULL DEFAULT '0',
  sorting INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  uid_foreign INT(11) UNSIGNED NOT NULL DEFAULT '0',
  sorting_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,

  PRIMARY KEY (uid)
);