--������SQL


-- �������ݵ��Զ����ֶα�
INSERT INTO `crm_sys_field` (`entity_name`, `field_name`, `field_label`, `field_length`, `field_precision`, `main_type`, `sub_type`, `default_value`, `if_track`, `if_import`, `if_export`, `picklist_name`, `if_forbid`, `priv_level`, `if_layout`, `if_view`, `field_order`, `create_man`, `create_time`, `update_man`, `update_time`, `default_type`, `field_remark`, `field_range`, `autocode_rule`, `autocode_start_num`, `autocode_add_num`, `autocode_num_length`, `reference_entity`, `autocode_max_num`, `field_type`, `reference_entity_view`, `field_control`, `field_control_ze`) VALUES
('crm_account', 'account_field1', '�Ǽ�����', NULL, NULL, 'time', 'date', NULL, 1, 1, 1, NULL, 0, 3, 1, 1, 51, 'admin', 1358265738, 'admin', 1358265738, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field10', '������ҵ', NULL, NULL, 'bool', 'bool', 'null', 0, 1, 1, NULL, 0, 3, 1, 1, 60, 'admin', 1358266051, 'admin', 1358266051, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field11', '���¼', NULL, NULL, 'text', 'textarea', NULL, 1, 1, 1, NULL, 0, 3, 1, 1, 61, 'admin', 1358266127, 'admin', 1358266127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field12', '����ʷ', NULL, NULL, 'text', 'textarea', NULL, 0, 1, 1, NULL, 0, 3, 1, 1, 62, 'admin', 1358266146, 'admin', 1358266146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field13', '�����������', NULL, NULL, 'text', 'textarea', NULL, 0, 1, 1, NULL, 0, 3, 1, 1, 63, 'admin', 1358266160, 'admin', 1358266160, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field14', '�������', NULL, NULL, 'option', 'select', NULL, 0, 1, 1, 'PICKLIST_1003', 0, 3, 1, 1, 64, 'admin', 1358266213, 'admin', 1358266213, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field15', '���˴���', NULL, NULL, 'text', 'text', NULL, 0, 1, 1, NULL, 0, 3, 1, 1, 65, 'admin', 1358266230, 'admin', 1358266230, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field2', '�绰2', NULL, NULL, 'text', 'text', NULL, 1, 1, 1, NULL, 0, 3, 1, 1, 52, 'admin', 1358265791, 'admin', 1358265791, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field3', '����', NULL, NULL, 'option', 'select', NULL, 0, 1, 1, 'PICKLIST_1001', 0, 3, 1, 1, 53, 'admin', 1358265841, 'admin', 1358265841, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field4', 'Ͷ���ܶ�', NULL, NULL, 'text', 'text', NULL, 0, 1, 1, NULL, 0, 3, 1, 1, 54, 'admin', 1358265856, 'admin', 1358265856, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field5', 'ע���ʽ�', '100', NULL, 'text', 'text', NULL, 0, 1, 1, NULL, 0, 3, 1, 1, 55, 'admin', 1358265878, 'admin', 1358265878, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field6', 'Ͷ�ʹ���', '100', NULL, 'text', 'text', NULL, 0, 1, 1, NULL, 0, 3, 1, 1, 56, 'admin', 1358265969, 'admin', 1358265969, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field8', '��Ա֤��', NULL, NULL, 'text', 'text', NULL, 1, 1, 1, NULL, 0, 3, 1, 1, 58, 'admin', 1358266005, 'admin', 1358266005, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_account', 'account_field9', '��Ա����', NULL, NULL, 'text', 'text', NULL, 1, 1, 1, NULL, 0, 3, 1, 1, 59, 'admin', 1358266017, 'admin', 1358266017, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL);
--('crm_account', 'account_field16', '������ί�� ', NULL, NULL, 'text', 'text', NULL, 0, 1, 1, NULL, 0, 3, 1, 1, 66, 'admin', 1358266240, 'admin', 1358266240, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
--('crm_account', 'account_field7', '�������', NULL, NULL, 'text', 'text', NULL, 0, 1, 1, NULL, 0, 3, 1, 1, 57, 'admin', 1358265992, 'admin', 1358265992, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),

--INSERT INTO `crm_sys_field` (`entity_name`, `field_name`, `field_label`, `field_length`, `field_precision`, `main_type`, `sub_type`, `default_value`, `if_track`, `if_import`, `if_export`, `picklist_name`, `if_forbid`, `priv_level`, `if_layout`, `if_view`, `field_order`, `create_man`, `create_time`, `update_man`, `update_time`, `default_type`, `field_remark`, `field_range`, `autocode_rule`, `autocode_start_num`, `autocode_add_num`, `autocode_num_length`, `reference_entity`, `autocode_max_num`, `field_type`, `reference_entity_view`, `field_control`, `field_control_ze`) VALUES
--('crm_account', 'company_nature', '��˾����', NULL, NULL, 'option', 'select', NULL, 0, 1, 1, 'PICKLIST_25', 0, 3, 1, 1, 43, 'admin', 1345719205, 'admin', 1345719205, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'sys', NULL, 'none', NULL);

INSERT INTO `crm_sys_field` (`entity_name`, `field_name`, `field_label`, `field_length`, `field_precision`, `main_type`, `sub_type`, `default_value`, `if_track`, `if_import`, `if_export`, `picklist_name`, `if_forbid`, `priv_level`, `if_layout`, `if_view`, `field_order`, `create_man`, `create_time`, `update_man`, `update_time`, `default_type`, `field_remark`, `field_range`, `autocode_rule`, `autocode_start_num`, `autocode_add_num`, `autocode_num_length`, `reference_entity`, `autocode_max_num`, `field_type`, `reference_entity_view`, `field_control`, `field_control_ze`) VALUES
('crm_salepay', 'salepay_field1', '���', '4', NULL, 'number', 'int', NULL, 0, 1, 1, NULL, 0, 3, 1, 1, 17, 'admin', 1356193373, 'admin', 1356193373, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL),
('crm_salepay', 'salepay_field2', '��Ʒ', NULL, NULL, 'reference', 'reference', NULL, 0, 1, 1, NULL, 0, 3, 1, 1, 18, 'admin', 1356193421, 'admin', 1356193421, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'crm_product', 0, 'define', 10015, 'none', NULL),
('crm_salepay', 'salepay_field3', '��ѿ���', NULL, NULL, 'text', 'text', NULL, 0, 1, 1, NULL, 0, 3, 1, 1, 19, 'admin', 1356370029, 'admin', 1356370029, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'define', NULL, 'none', NULL);



-- ��Ա����ֶ�
ALTER TABLE  `crm_account` ADD  `account_field1` INT NULL;
ALTER TABLE  `crm_account` ADD  `account_field2` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field3` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field4` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field5` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field6` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field7` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field8` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field9` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field10` INT NULL;
ALTER TABLE  `crm_account` ADD  `account_field11` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field12` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field13` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field14` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field15` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field16` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_account` ADD  `account_field17` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;	
ALTER TABLE  `crm_account` ADD  `field1` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;	
ALTER TABLE  `crm_account` ADD  `field2` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;	
ALTER TABLE  `crm_account` ADD  `field3` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;	
ALTER TABLE  `crm_account` ADD  `field4` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;		
--ALTER TABLE  `crm_account` ADD  `company_nature` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci  NULL;


-- �������ݵ�������
REPLACE INTO `crm_sys_picklist` (`picklist_name`, `picklist_label`, `picklist_items`, `picklist_items_priv`) VALUES
('PICKLIST_1000', '��Ա���', 'A-���Ļ�Ա\r\nB-�����Ա\r\nB1-��Ե��Ա\r\nT-�����Ա\r\nC-�����Ա\r\nX-�»�Ա', NULL),
('PICKLIST_1001', '����', 'YEN\r\nUSD\r\nRMB\r\nHKD\r\n', NULL),
('PICKLIST_1002', '�ʱ�', '528467', NULL),
('PICKLIST_1003', '�������', '�Զ�\r\n�˹�', NULL);


-- �������ݵ�״̬��



-- �����Ʒ���
REPLACE INTO `crm_product_type` (`id`, `create_time`, `update_time`, `create_man`, `create_man_text`, `update_man`, `update_man_text`, `owner`, `owner_dept`, `create_dept`, `create_dept_text`, `deleted`, `share_man`, `share_op`, `product_type_name`, `product_type_code`, `parent_id`, `remark`, `parent_id_text`) VALUES
(1, 1327247576, 1327247594, 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', '1', '1', NULL, 0, NULL, NULL, '���', '100000', '-1', NULL, '������(000000)'),
(2, 1327247598, 1327247608, 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', '1', '1', NULL, 0, NULL, NULL, 'ѧϰ��', '200000', '-1', NULL, '������(000000)');

-- �����Ʒ
REPLACE INTO `crm_product` (`id`, `create_time`, `update_time`, `create_man`, `create_man_text`, `update_man`, `update_man_text`, `owner`, `owner_dept`, `create_dept`, `create_dept_text`, `deleted`, `share_man`, `share_op`, `product_name`, `product_code`, `product_specification`, `measure_id`, `product_type_id`, `product_type_id_text`, `product_band`, `product_place`, `product_cost`, `product_price`, `remark`, `ATTACHMENT_ID`, `ATTACHMENT_ID_text`, `field11`) VALUES
(1, 1327247496, 1356360645, 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', '1', '1', NULL, 0, NULL, NULL, '�᳤', '20120122235342', '�᳤', NULL, '1', '���', NULL, NULL, 60000.000000, 60000.000000, NULL, NULL, NULL, NULL),
(2, 1327247639, 1356360635, 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', '1', '1', NULL, 0, NULL, NULL, '��ͨ��Ա', '20120122235423', '��ͨ��Ա���', NULL, '1', '���', NULL, NULL, 2000.000000, 2000.000000, NULL, NULL, NULL, NULL),
(3, 1356360652, 1356360667, 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', '1', '1', NULL, 0, NULL, NULL, '����', '20121224225107', '����', NULL, '1', '���', NULL, NULL, 0.000000, 5000.000000, NULL, NULL, NULL, NULL),
(4, 1356360670, 1356360683, 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', '1', '1', NULL, 0, NULL, NULL, '��������', '20121224225123', '��������', NULL, '1', '���', NULL, NULL, 0.000000, 8000.000000, NULL, NULL, NULL, NULL),
(5, 1356360689, 1356360700, 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', '1', '1', NULL, 0, NULL, NULL, '�� �� ��', '20121224225140', '�� �� ��', NULL, '1', '���', NULL, NULL, 0.000000, 20000.000000, NULL, NULL, NULL, NULL),
(6, 1356360706, 1356360714, 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', '1', '1', NULL, 0, NULL, NULL, '���񸱻᳤', '20121224225154', '���񸱻᳤', NULL, '1', '���', NULL, NULL, 0.000000, 30000.000000, NULL, NULL, NULL, NULL),
(7, 1356360720, 1356360729, 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', '1', '1', NULL, 0, NULL, NULL, '�ﲹ������', '20121224225209', '�ﲹ������', NULL, '1', '���', NULL, NULL, 0.000000, 1000.000000, NULL, NULL, NULL, NULL),
(8, 1356360735, 1356360745, 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', '1', '1', NULL, 0, NULL, NULL, '����', '20121224225225', '����', NULL, '1', '���', NULL, NULL, 0.000000, 5000.000000, NULL, NULL, NULL, NULL);


-- ��ѱ���ֶ�
ALTER TABLE  `crm_salepay` ADD  `salepay_field1` INT NULL;
ALTER TABLE  `crm_salepay` ADD  `salepay_field2` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_salepay` ADD  `salepay_field2_text` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;
ALTER TABLE  `crm_salepay` ADD  `salepay_field3` TEXT CHARACTER SET gbk COLLATE gbk_chinese_ci NULL;


--DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_rela' LIMIT 1 ;
 DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_phase' LIMIT 1 ;
DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_sex' LIMIT 1 ;
DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_position' LIMIT 1 ;
DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_addr_province' LIMIT 1;
DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_addr_city' LIMIT 1;
DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_wangwang' LIMIT 1;
DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_msn_qq' LIMIT 1;
DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_delivery_country' LIMIT 1;
DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_delivery_city' LIMIT 1;
DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_bank_person' LIMIT 1;
DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_credit' LIMIT 1;
--DELETE FROM `TD_OA`.`crm_sys_field` WHERE `crm_sys_field`.`entity_name` = 'crm_account' AND `crm_sys_field`.`field_name` = 'account_mobile' LIMIT 1;

ALTER TABLE `crm_account`
  DROP `account_sex`,
  DROP `account_phase`,
  DROP `account_addr_province`,
  DROP `account_addr_city`,
  DROP `account_wangwang`,
  DROP `account_msn_qq`,
  DROP `account_delivery_country`,
  DROP `account_delivery_city`,
  DROP `account_bank_person`,
  DROP `account_credit`,
  DROP `account_position`;
 -- DROP `account_rela`,
 -- DROP `account_mobile`,