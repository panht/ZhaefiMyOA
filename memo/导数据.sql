--������SQL


-- �����Ա��
truncate table TD_OA.`crm_account`;
insert into TD_OA.`crm_account` 
(account_field1, account_name, account_status, account_addr, account_post, account_phone, account_field2, account_fax,
 account_industry, industry_desc, account_field3, account_field4, account_field5, company_nature, account_field6, account_birthday, account_field8, account_field9, remark,
 update_man, update_time, account_url, account_email, account_field10, account_field12, account_field14, account_type, account_field15, deleted, field3, field4)
select 
HY_REG, HY_NAM, HY_STA, HY_ADD, HY_POT, HY_TEL, HY_TE2, HY_FAX, 
HY_TRA, HY_PRO, HY_CUR, HY_AMO, HY_CAP, HY_TYP, HY_NAT,  unix_timestamp(`HY_JOI`), HY_CER, HY_COD, HY_MEM, 
HY_CXM, HY_CRQ, hy_url, HY_email, ������ҵ, ����ʷ, FaxType, MemberType, CorperationCode, 0, HY_PRE, HY_MAN
from wsxh2012.xhhy where hy_sta in (10, 20, 60);
--account_field13, , concat(�����������, '\n', ��Э����ϵ��¼),

-- ����������Ϻ���Э����ϵ��¼����crm_customer_service��
truncate table TD_OA.crm_customer_service;
insert into TD_OA.crm_customer_service
(account_id_text, service_content, remark, `deleted`)
select HY_NAM, �����������, ��Э����ϵ��¼, 0
from wsxh2012.xhhy where hy_sta in (10, 20, 60)
and ((����������� is not null and ����������� <> '') or (��Э����ϵ��¼ is not null and ��Э����ϵ��¼ <> ''));
update TD_OA.crm_customer_service set account_id =
(select id from TD_OA.`crm_account` where account_name = TD_OA.crm_customer_service.account_id_text limit 1);

-- ������ϵ�˱�
truncate table TD_OA.`crm_account_contact`;
-- ����������/���³�
--insert into TD_OA.`crm_account_contact` 
--(`create_time`, `update_time`, `create_man`, `create_man_text`, `update_man`, `update_man_text`, `owner`, `owner_dept`, `create_dept`, `deleted`, `account_id`, `account_id_text`, `contact_position`, `contact_name`)
--select unix_timestamp(now()), unix_timestamp(now()), 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', 1, 1, 0, 
--(select id from TD_OA.crm_account where account_name = HY_NAM limit 1), HY_NAM, '����������/���³�', HY_PRE 
--from wsxh2012.xhhy where hy_sta in (10, 20, 60) and HY_PRE is not null and HY_PRE <> '';
-- �ܾ���
--insert into TD_OA.`crm_account_contact` 
--(`create_time`, `update_time`, `create_man`, `create_man_text`, `update_man`, `update_man_text`, `owner`, `owner_dept`, `create_dept`, `deleted`, `account_id`, `account_id_text`, `contact_position`, `contact_name`)
--select unix_timestamp(now()), unix_timestamp(now()), 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', 1, 1, 0, 
--(select id from TD_OA.crm_account where account_name = HY_NAM limit 1), HY_NAM, '�ܾ���', HY_MAN 
--from wsxh2012.xhhy where hy_sta in (10, 20, 60) and HY_MAN is not null and HY_MAN <> '';
-- Э�������
insert into TD_OA.`crm_account_contact` 
(`create_time`, `update_time`, `create_man`, `create_man_text`, `update_man`, `update_man_text`, `owner`, `owner_dept`, `create_dept`, `deleted`, `account_id`, `account_id_text`, `contact_position`, contact_phone, `contact_mobile`, `contact_name`)
select unix_timestamp(now()), unix_timestamp(now()), 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', 1, 
1, 0, 
(select id from TD_OA.crm_account where account_name = HY_NAM limit 1), HY_NAM, 'Э�������', hy_contel, hy_concel, HY_CON 
from wsxh2012.xhhy where hy_sta in (10, 20, 60) and ((hy_con is not null and hy_con <> '') or (hy_contel is not null and hy_contel <> '') or (hy_concel is not null and hy_concel <> ''));
-- ������ϵ��
insert into TD_OA.`crm_account_contact` 
(`create_time`, `update_time`, `create_man`, `create_man_text`, `update_man`, `update_man_text`, `owner`, `owner_dept`, `create_dept`, `deleted`, `account_id`, `account_id_text`, `contact_position`, contact_phone, `contact_mobile`, `contact_name`)
select unix_timestamp(now()), unix_timestamp(now()), 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', 1, 
1, 0, 
(select id from TD_OA.crm_account where account_name = HY_NAM limit 1), HY_NAM, '������ϵ��', hy_contel1, hy_concel1, hy_con1
from wsxh2012.xhhy where hy_sta in (10, 20, 60) and ((hy_con1 is not null and hy_con1 <> '') or (hy_contel1 is not null and hy_contel1 <> '') or (hy_concel1 is not null and hy_concel1 <> ''));
-- ������ϵ��
insert into TD_OA.`crm_account_contact` 
(`create_time`, `update_time`, `create_man`, `create_man_text`, `update_man`, `update_man_text`, `owner`, `owner_dept`, `create_dept`, `deleted`, `account_id`, `account_id_text`, `contact_position`, contact_phone, `contact_mobile`, `contact_name`)
select unix_timestamp(now()), unix_timestamp(now()), 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', 1, 
1, 0, 
(select id from TD_OA.crm_account where account_name = HY_NAM limit 1), HY_NAM, '������ϵ��', hy_contel2, hy_concel2, hy_con2
from wsxh2012.xhhy where hy_sta in (10, 20, 60) and ((hy_con2 is not null and hy_con2 <> '') or (hy_contel2 is not null and hy_contel2 <> '') or (hy_concel2 is not null and hy_concel2 <> ''));
-- HR��ϵ��
insert into TD_OA.`crm_account_contact` 
(`create_time`, `update_time`, `create_man`, `create_man_text`, `update_man`, `update_man_text`, `owner`, `owner_dept`, `create_dept`, `deleted`, `account_id`, `account_id_text`, `contact_position`, contact_phone, `contact_mobile`, `contact_name`)
select unix_timestamp(now()), unix_timestamp(now()), 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', 1, 
1, 0, 
(select id from TD_OA.crm_account where account_name = HY_NAM limit 1), HY_NAM, 'HR��ϵ��', hy_contel3, hy_concel3, hy_con3
from wsxh2012.xhhy where hy_sta in (10, 20, 60) and ((hy_con3 is not null and hy_con3 <> '') or (hy_contel3 is not null and hy_contel3 <> '') or (hy_concel3 is not null and hy_concel3 <> ''));
-- ������ϵ��
insert into TD_OA.`crm_account_contact` 
(`create_time`, `update_time`, `create_man`, `create_man_text`, `update_man`, `update_man_text`, `owner`, `owner_dept`, `create_dept`, `deleted`, `account_id`, `account_id_text`, `contact_position`, contact_phone, `contact_mobile`, `contact_name`)
select unix_timestamp(now()), unix_timestamp(now()), 'admin', 'ϵͳ����Ա', 'admin', 'ϵͳ����Ա', 'admin', 1, 
1, 0, 
(select id from TD_OA.crm_account where account_name = HY_NAM limit 1), HY_NAM, '������ϵ��', hy_contel4, hy_concel4, hy_con4
from wsxh2012.xhhy where hy_sta in (10, 20, 60) and ((hy_con4 is not null and hy_con4 <> '') or (hy_contel4 is not null and hy_contel4 <> '') or (hy_concel4 is not null and hy_concel4 <> ''));



-- ������ϵ��¼
delete from wsxh2012.ContactRecord where memberid not in (select id from wsxh2012.xhhy where hy_sta in (10, 20, 60));

-- ��ϵ��¼����ͻ��ػ�
truncate table TD_OA.`crm_account_care`;
INSERT INTO TD_OA.`crm_account_care` ( `create_time`, `update_time`, `create_man`, `create_man_text`, `update_man`, `update_man_text`, `owner`, `owner_dept`, `create_dept`, `deleted`, 
`execution_man`, `account_id`, `account_id_text`, 
`account_care_date`, `contact_id_text`, `account_care_content`, `charge_person`, `charge_person_text`) 
select unix_timestamp(contactdate), unix_timestamp(contactdate), adduser, adduser, adduser, adduser, adduser, 1, 1, 0, 
contactman,
(select id from TD_OA.crm_account where account_name = (select HY_NAM from wsxh2012.XHHY where id = wsxh2012.ContactRecord.memberid limit 1) limit 1), 
(select HY_NAM from wsxh2012.XHHY where id = wsxh2012.ContactRecord.memberid limit 1),
unix_timestamp(contactdate), contactman, content, adduser, adduser
from wsxh2012.ContactRecord;


-- �����ѱ�
delete from wsxh2012.huifei where id not in (select id from wsxh2012.xhhy where hy_sta in (10, 20, 60));
truncate table TD_OA.`crm_salepay`;
insert into TD_OA.`crm_salepay`
(`create_time`, `update_time`, `create_man`, `create_man_text`, `update_man`, `update_man_text`, `owner`, `owner_dept`, `create_dept`, `deleted`,  
`account_id`,  `collection_date`, `collection_amount`, `hd_collection_man`, `hd_collection_man_text`, remark, `salepay_title`, `salepay_field2`, `salepay_field2_text`, `contract_id`)
select 
unix_timestamp(h.HF_CRQ), unix_timestamp(h.HF_CRQ), h.HF_CXM, h.HF_CXM, h.HF_CXM, h.HF_CXM, h.HF_CXM, 1, 
1, 0, 
h.id, unix_timestamp(h.HF_DAT), h.HF_AMO, h.HF_CXM, h.HF_CXM, HF_GIV, h.HF_YEA, 
p.id, p.product_name, h.HF_COD
from wsxh2012.huifei h left JOIN TD_OA.crm_product p on p.product_price=h.HF_AMO
  where h.HF_AMO > 0 and h.HF_YEA > 0 and p.product_type_id=1
 ;
 -- ���»�ѱ�Ļ�ԱID�����ƣ�����id��ѯ��û��id�ĸ��ݻ�ѿ���
update TD_OA.crm_salepay set `account_id_text` = (select hy_nam from wsxh2012.xhhy where id = TD_OA.crm_salepay.account_id limit 1);
update TD_OA.crm_salepay set `account_id` = (select id from TD_OA.crm_account where account_name = crm_salepay.account_id_text limit 1);




/*
-- ���빩Ӧ��
--, `charge_person`, `charge_person_text`
truncate table TD_OA.`crm_supplier`;
INSERT INTO TD_OA.`crm_supplier`(`supplier_name`, `supplier_code`, `supplier_phone`, `supplier_fax`, `supplier_email`,`supplier_country`,`supplier_zip_code`, `remark`, `deleted`
) 
SELECT distinct
��λ, ���, �绰, ����, email, ����, �ʱ�, ��ע, 0
from wsxh2012.xhls;

-- , `charge_person`, `charge_person_text`
-- 
truncate table TD_OA.`crm_supplier_contact`;
INSERT INTO TD_OA.`crm_supplier_contact`(`supplier_contact_name`, `supplier_contact_post`, `supplier_contact_sex`, `supplier_contact_phone`, `supplier_contact_fax`, `supplier_contact_mobile`, `supplier_contact_email`, `supplier_contact_birthday`, `supplier_contact_msn`, `deleted`) 
SELECT distinct
����, ְ��, �Ա�, �绰, ����, �绰2, email, ����, ���, 0
from wsxh2012.xhls;
update TD_OA.`crm_supplier_contact` c set c.supplier_id =
(select a.id from TD_OA.`crm_supplier` a, wsxh2012.xhls b where a.supplier_name=b.��λ and b.����=c.supplier_contact_name and a.supplier_code=c.supplier_contact_msn limit 1)
where c.supplier_id is null;

INSERT INTO TD_OA.`crm_supplier_contact`(`supplier_contact_name`, `supplier_contact_phone`, `supplier_contact_msn`,`deleted`) 
SELECT distinct
��ϵ��, ��ϵ�˵绰, ���, 0
from wsxh2012.xhls where (��ϵ�� is not null and ��ϵ�� <> '') or (��ϵ�˵绰 is not null and ��ϵ�˵绰 <> '');
update TD_OA.`crm_supplier_contact` c set c.supplier_id =
(select a.id from TD_OA.`crm_supplier` a, wsxh2012.xhls b where a.supplier_name=b.��λ and b.��ϵ��=c.supplier_contact_name and a.supplier_code=c.supplier_contact_msn limit 1)
where c.supplier_id is null;

update TD_OA.`crm_supplier_contact` set supplier_contact_msn = '';
*/