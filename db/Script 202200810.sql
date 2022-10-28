

	 -- ------------------------------------------------------
	--  DDL for Table ADM_VERSIONAPP  2020/08/10 00:00:00
	-- ------------------------------------------------------

	update ADM_VERSIONAPP set ESTADO='N', FCREA='2020/08/10 00:00:00';
	INSERT INTO ADM_VERSIONAPP  (ID, NOMBRE, ESTADO,FCREA) VALUES (13, 'Versión 2020.08.10', 'S',  '2020/08/10 00:00:00');
	
	
--------------------------------------------------------
--  DDL for Table ORD_CONTACTOUSUARIO
--------------------------------------------------------


  CREATE TABLE ORD_CONTACTOUSUARIO
   (	
    ID int NOT NULL, 
	ID_ENCORDEN int NOT NULL, 
	CORREO VARCHAR(1000) NULL, 
	MOVIL VARCHAR(1000) NULL, 
	TELEFONO VARCHAR(1000) NULL,
	DIRECCION VARCHAR(1000) NULL,
	ID_MUNICIPIO int NOT NULL, 
	ID_EMPRESA int  NULL, 
	ID_CONVENIO int  NULL, 
	ESTADO VARCHAR(1) NOT NULL, 
	UCREA VARCHAR(100) NOT NULL, 
	FCREA VARCHAR(30) NOT NULL, 
	UMOD VARCHAR(100) NOT NULL, 
	FMOD VARCHAR(30) NOT NULL
   ) ;

ALTER TABLE ORD_CONTACTOUSUARIO ADD PRIMARY KEY (ID);
ALTER TABLE ORD_CONTACTOUSUARIO ADD FOREIGN KEY (ID_ENCORDEN ) REFERENCES ORD_ENCORDEN(ID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE ORD_CONTACTOUSUARIO ADD FOREIGN KEY (ID_MUNICIPIO ) REFERENCES ADM_MUNICIPIO(ID) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE ORD_CONTACTOUSUARIO ADD FOREIGN KEY (ID_EMPRESA ) REFERENCES COT_TARIFAEMPRESA(ID) ON DELETE NO ACTION ON UPDATE NO ACTION;



	--------------------------------------------------------
	--  Records of  Table ADM_MODULO
	--------------------------------------------------------

	-- update ADM_MODULO set PAGINA='OrdersAppOrder/updateUserInformation' where id=	10005;
	
	--------------------------------------------------------
	--  Records of  Table ADM_MODFUNCIONES
	--------------------------------------------------------
	UPDATE ADM_MODFUNCIONES SET ICONO='fa fa-tachometer' WHERE ID=160; 
	UPDATE ADM_MODFUNCIONES SET ICONO='fa fa-tachometer' WHERE ID=161; 

	--------------------------------------------------------
	--  Records of  Table ADM_MODFUNCIONES
	--------------------------------------------------------
	
	INSERT INTO ADM_MODFUNCIONES VALUES (278, 10003, 10, 'orderList', 'Actualizar contacto', 'OrdersAppOrder/updateUserInformation/', 'fa fa-map-marker', NULL, 'S', 'adrian.ducuara', '1900/01/01 00:00:00', 'adrian.ducuara', '1900/01/01 00:00:00');
	
	
	
	-- ----------------------------
	-- Records of ADM_MODFUNROLPER
	-- ----------------------------
	INSERT INTO ADM_MODFUNROLPER VALUES (1236, 278, 1, 'S', 'adrian.ducuara', '1900/01/01 00:00:00', 'adrian.ducuara', '1900/01/01 00:00:00');
	
	
	
	-- ----------------------------
-- Records of ADM_ENCMENSAJE and ADM_DETMENSAJE
-- ----------------------------
INSERT INTO ADM_ENCMENSAJE VALUES (114, 'editUserOrder', 'success', 'S', 'adrian.ducuara', '1900/01/01 00:00:00', 'adrian.ducuara', '1900/01/01 00:00:00');
 INSERT INTO ADM_DETMENSAJE VALUES (114, 114, 1, 'Información actualizada', 'Se ha actualizado la información de contacto para el paciente relacionado con la orden', 'S', 
									'adrian.ducuara', '1900/01/01 00:00:00', 'adrian.ducuara', '1900/01/01 00:00:00');	