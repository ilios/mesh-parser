DROP TABLE IF EXISTS `mesh_user_selection`;
CREATE TABLE `mesh_user_selection` (
  `mesh_user_selection_id` int(14) unsigned NOT NULL auto_increment,
  `mesh_descriptor_uid` varchar(9) character set utf8 collate utf8_unicode_ci NOT NULL,
  `search_phrase` varchar(127) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`mesh_user_selection_id`),
  FULLTEXT KEY `sp_index` (`search_phrase`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mesh_tree_x_descriptor`;
CREATE TABLE `mesh_tree_x_descriptor` (
  `tree_number` varchar(31) character set utf8 collate utf8_unicode_ci NOT NULL,
  `mesh_descriptor_uid` varchar(9) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`tree_number`),
  KEY `mesh_descriptor_uid` USING BTREE (`mesh_descriptor_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mesh_descriptor`;
CREATE TABLE `mesh_descriptor` (
  `mesh_descriptor_uid` varchar(9) collate utf8_unicode_ci NOT NULL,
  `name` varchar(192) collate utf8_unicode_ci NOT NULL,
  `annotation` text collate utf8_unicode_ci,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`mesh_descriptor_uid`),
  FULLTEXT KEY `n_index` (`name`),
  FULLTEXT KEY `a_index` (`annotation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `mesh_previous_indexing`;
CREATE TABLE `mesh_previous_indexing` (
  `mesh_descriptor_uid` varchar(9) collate utf8_unicode_ci NOT NULL,
  `previous_indexing` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`mesh_descriptor_uid`),
  FULLTEXT KEY `pi_index` (`previous_indexing`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `mesh_qualifier`;
CREATE TABLE `mesh_qualifier` (
  `mesh_qualifier_uid` varchar(9) collate utf8_unicode_ci NOT NULL,
  `name` varchar(60) collate utf8_unicode_ci NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`mesh_qualifier_uid`),
  FULLTEXT KEY `n_index` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `mesh_semantic_type`;
CREATE TABLE `mesh_semantic_type` (
  `mesh_semantic_type_uid` varchar(9) collate utf8_unicode_ci NOT NULL,
  `name` varchar(192) collate utf8_unicode_ci NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mesh_semantic_type_uid`),
  FULLTEXT KEY `n_index` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `mesh_term`;
CREATE TABLE `mesh_term` (
  `mesh_term_uid` varchar(9) collate utf8_unicode_ci NOT NULL,
  `name` varchar(192) collate utf8_unicode_ci NOT NULL,
  `lexical_tag` varchar(12) collate utf8_unicode_ci default NULL,
  `concept_preferred` tinyint(1) default NULL,
  `record_preferred` tinyint(1) default NULL,
  `permuted` tinyint(1) default NULL,
  `print` tinyint(1) default NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mesh_term_uid`, `name`),
  KEY `mesh_term_uid` USING BTREE (`mesh_term_uid`),
  FULLTEXT KEY `n_index` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `mesh_concept`;
CREATE TABLE `mesh_concept` (
  `mesh_concept_uid` varchar(9) collate utf8_unicode_ci NOT NULL,
  `name` varchar(192) collate utf8_unicode_ci NOT NULL,
  `umls_uid` varchar(9) collate utf8_unicode_ci NOT NULL,
  `preferred` tinyint(1) NOT NULL,
  `scope_note` text collate utf8_unicode_ci,
  `casn_1_name` varchar(127) collate utf8_unicode_ci default NULL,
  `registry_number` varchar(30) collate utf8_unicode_ci default NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`mesh_concept_uid`),
  FULLTEXT KEY `n_index` (`name`),
  FULLTEXT KEY `sn_index` (`scope_note`),
  FULLTEXT KEY `cn_index` (`casn_1_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `mesh_descriptor_x_concept`;
CREATE TABLE `mesh_descriptor_x_concept` (
  `mesh_concept_uid` varchar(9) character set utf8 collate utf8_unicode_ci NOT NULL,
  `mesh_descriptor_uid` varchar(9) character set utf8 collate utf8_unicode_ci NOT NULL,
  KEY `mesh_concept_uid` USING BTREE (`mesh_concept_uid`),
  KEY `mesh_descriptor_uid` USING BTREE (`mesh_descriptor_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mesh_descriptor_x_qualifier`;
CREATE TABLE `mesh_descriptor_x_qualifier` (
  `mesh_descriptor_uid` varchar(9) character set utf8 collate utf8_unicode_ci NOT NULL,
  `mesh_qualifier_uid` varchar(9) character set utf8 collate utf8_unicode_ci NOT NULL,
  KEY `mesh_descriptor_uid` USING BTREE (`mesh_descriptor_uid`),
  KEY `mesh_qualifier_uid` USING BTREE (`mesh_qualifier_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mesh_concept_x_semantic_type`;
CREATE TABLE `mesh_concept_x_semantic_type` (
  `mesh_concept_uid` varchar(9) character set utf8 collate utf8_unicode_ci NOT NULL,
  `mesh_semantic_type_uid` varchar(9) character set utf8 collate utf8_unicode_ci NOT NULL,
  KEY `mesh_concept_uid` USING BTREE (`mesh_concept_uid`),
  KEY `mesh_semantic_type_uid` USING BTREE (`mesh_semantic_type_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mesh_concept_x_term`;
CREATE TABLE `mesh_concept_x_term` (
  `mesh_concept_uid` varchar(9) character set utf8 collate utf8_unicode_ci NOT NULL,
  `mesh_term_uid` varchar(9) character set utf8 collate utf8_unicode_ci NOT NULL,
  KEY `mesh_concept_uid` USING BTREE (`mesh_concept_uid`),
  KEY `mesh_term_uid` USING BTREE (`mesh_term_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
