รายละเอียด WSDL URL และ Service endpoint URL ของ interface เส้นใหม่และเส้นเก่าที่เพิ่มฟิวมาตามด้านล่างนะครับ ซึ่งเป็น URL ที่ระบบ DEV อยู่นะครับ โดยเอกสารโครงสร้างต่างๆนั้นสามารถดูตาม functional spec ของ SAP ได้เลยครับ

หากต้องการเป็น WSDL File ก็ได้แนบไว้กับเมลฉบับนี้แล้วเช่นกันนะคัรบ

เส้นเก่าที่ทำการเพิ่มเติมโครงสร้าง

ESS - Advance Post
DEV WSDL URL : http://bkk1svrid11.big.th.com:50000/dir/wsdl?p=sa/5023698e48a03aaaa6632e994b63d1a7
DEV Service URL : http://bkk1svrid11.big.th.com:50000/XISOAPAdapter/MessageServlet?senderParty=&senderService=BC_ESS_ADVANCE&receiverParty=&receiverService=&interface=SI_ESS_Advance_Post_Req&interfaceNamespace=urn:big:advance:ecc
ESS - Clearing Post
DEV WSDL URL : http://bkk1svrid11.big.th.com:50000/dir/wsdl?p=sa/413da320b5383568916a4d7e846de12d
DEV Service URL : http://bkk1svrid11.big.th.com:50000/XISOAPAdapter/MessageServlet?senderParty=&senderService=BC_ESS_ADVANCE&receiverParty=&receiverService=&interface=SI_ESS_Clearing_Post_Req&interfaceNamespace=urn:big:advance:ecc
 

เส้นใหม่ new interface

Choose Clear EES (CCLR EES)
DEV WSDL URL : http://bkk1svrid11.big.th.com:50000/dir/wsdl?p=sa/b501e7211f0e30cd8ca6643082b0f221
DEV Service URL : http://bkk1svrid11.big.th.com:50000/XISOAPAdapter/MessageServlet?senderParty=&senderService=BC_EFORM&receiverParty=&receiverService=&interface=SI_CCLR_EES_OS&interfaceNamespace=urn:big:eform:ecc
Choose Clear Advance (CCLR Advance)
DEV WSDL URL : http://bkk1svrid11.big.th.com:50000/dir/wsdl?p=sa/966155421ef3387d9544768aa719737e
DEV Service URL : http://bkk1svrid11.big.th.com:50000/XISOAPAdapter/MessageServlet?senderParty=&senderService=BC_EFORM&receiverParty=&receiverService=&interface=SI_CCLR_Advance_OS&interfaceNamespace=urn:big:eform:ecc
 

การ Authenticate

ผมรบกวนใช้ User/Pass เดิมที่มีอยู่ในมือนะครับ (password จะต่างกับ PRD นะครับ) หากติดปัญหาแจ้งกลับได้เลยครับ