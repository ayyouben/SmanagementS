    --========================================================================
	--===                 GESTION STOCK PHP 7 - MYSQL                      ===
    --===                                                                  ===
    --===  MYSQL SERVER - PHP 7                                            ===
    --===  Data Base Name : textileProd                                    ===
    --===  DEVELOPER PAR  : BENZAKOUR AYYOUB                               ===
    --===  EMAIL    : AYYOUB.BENZAKOUR@GMAIM.COM                           ===
    --===  WHATSAPP : +212636039153                                        ===
	--========================================================================

    --========================================================================
    --===                       CREATION DES TABLES                        ===
    --========================================================================

/*==================================== Cofiguration =======================================*/

    CREATE TABLE  config(
        NonSo varchar(200) primary key,
        Domaine varchar(200) NULL,
        logo varchar(255) NULL,
        Adresse varchar(250) NULL,
        Tele varchar(20) NULL,
        RC varchar(10) NULL,
        Patente varchar(20) NULL,
        IFF varchar(20) NULL,
        CNSS varchar(20) NULL,
        ICE varchar(40) NULL
    );

/*==================================== Categorie ==========================================*/

	CREATE TABLE  Categorie(
        Id_Cat int primary key  AUTO_INCREMENT NOT NULL,
        NomCat varchar(50) NOT NULL
    );

/*================================= Caracteristique =======================================*/

	CREATE TABLE Caracteristique (
        Id_caract int PRIMARY key AUTO_INCREMENT Not NULL,
        Nom_caract varchar(50) NOT NULL,
        Unite varchar(10)
    );
/*==================================== Produit ============================================*/ 

    CREATE TABLE  Produit (
	Id_Prod  int primary key NOT NULL,
	Designation varchar(255) NOT NULL,
	Id_Cat int ,
    Prix float,
    QteS float,
    Id_caract int,
    foreign key  (Id_Cat) references Categorie(Id_Cat) on update cascade on delete cascade,
    foreign key  (Id_caract) references Caracteristique(Id_caract) on update cascade on delete cascade);

/*==================================== Caract_Val ==========================================*/  

    CREATE TABLE Caract_Val(
    Id_Prod int ,
    Id_caract int ,
    valeur varchar(20),
    foreign key  (Id_Prod) references Produit(Id_Prod) on update cascade on delete cascade,
    foreign key  (Id_caract) references Caracteristique(Id_caract) on update cascade on delete cascade
    );
     
/*======================================== Banque ==========================================*/ 

	CREATE TABLE  Banque(
	Num_Bq int primary key AUTO_INCREMENT NOT NULL,
	NomB varchar(100) NOT NULL);

/*======================================== Client ==========================================*/ 

    CREATE TABLE  Client(
	Id_Clt int primary key AUTO_INCREMENT NOT NULL,
	Nom_Clt varchar(50) NOT NULL,
	Ville varchar(50) NULL,
	Adresse varchar(50) NULL,
	Tele varchar(15) NULL,
	Email varchar(50) NULL,
	Solde float NULL,
	ICE varchar(30) NULL);

/*================================== Fournisseur ===========================================*/ 

	CREATE TABLE  Fournisseur(
	Id_Fr int  primary key AUTO_INCREMENT NOT NULL,
	NomF varchar(50) NOT NULL,
	Ville varchar(50) NULL,
	Adresse varchar(50) NULL,
	Tele varchar(15) NULL,
	Email varchar(50) NULL);

/*================================== CommandeAch ===========================================*/ 

	CREATE TABLE  CommandeAch(
	Num_Cmd int primary key ,
	DateAch datetime NOT NULL,
	IDFActureA varchar(20) NULL,
	Id_Fr int , 
    foreign key (Id_Fr) references Fournisseur(Id_Fr) on update cascade on delete cascade);

/*================================== DetailAchat ===========================================*/ 

	CREATE TABLE  DetailAchat(
	Id_Prod int , foreign key  (Id_Prod) references Produit(Id_Prod)on update cascade on delete cascade ,
	Num_Cmd int , foreign key (Num_Cmd) references CommandeAch(Num_cmd)on update cascade on delete cascade,
	Qte float NOT NULL,
	PrixA float NOT NULL,
    constraint pk_DetailAchat primary key (Id_Prod,Num_Cmd));

/*================================= CommandeVente ==========================================*/ 

	CREATE TABLE  CommandeVente(
	Num_CmdV int primary key  NOT NULL,
	DateCmd date NOT NULL,
	IsFacture bit NOT NULL,
	Id_Clt int , foreign key (Id_Clt) references Client(Id_Clt)on update cascade on delete cascade);

/*================================= DetailVente ===========================================*/ 

	CREATE TABLE  DetailVente(
	Num_CmdV int , foreign key (Num_CmdV) references CommandeVente(Num_CmdV)on update cascade on delete cascade,
	Id_Prod int , foreign key (Id_Prod) references Produit(Id_Prod)on update cascade on delete cascade,
	Qte float NOT NULL,
	Remise float NULL,
	PrixV float NOT NULL,
	TVA int ,constraint pk_d primary key (Num_CmdV, Id_Prod));
	
/*===================================== Facture ===========================================*/ 

	CREATE TABLE  Facture(
	Num_Fac int primary key AUTO_INCREMENT NOT NULL,
	DateFac date NOT NULL,
	Remise float NULL,
	IsGiven bit NULL
    );

/*===================================== DetailFac ===========================================*/ 

	CREATE TABLE  DetailFac(
	Num_Fac int , foreign key (Num_Fac) references Facture(Num_Fac)on update cascade on delete cascade,
	Num_CmdV int , foreign key (Num_CmdV) references CommandeVente(Num_cmdV)on update cascade on delete cascade,
	IDCmdFact int primary key AUTO_INCREMENT NOT NULL);

/*===================================== ModeRG ==============================================*/

	CREATE TABLE  ModeRG(
	Num_ModeReg int primary key AUTO_INCREMENT NOT NULL,
	Modalite varchar(50) NOT NULL);

/*===================================== Reglement ==============================================*/

	CREATE TABLE  Reglement(
	Num_Reg int primary key AUTO_INCREMENT NOT NULL,
	Montant float NOT NULL,
	NumChe varchar(50) NULL,
	Num_ModeReg int , foreign key (Num_ModeReg) references ModeRG(Num_ModeReg)on update cascade on delete cascade,
	Num_Bq int, foreign key (Num_Bq) references Banque(Num_Bq )on update cascade on delete cascade);

/*===================================== DetailReg ==============================================*/

	CREATE TABLE  DetailReg(
	Num_Reg int , foreign key (Num_Reg) references Reglement(Num_Reg)on update cascade on delete cascade,
	Num_CmdV int , foreign key (Num_CmdV) references CommandeVente(Num_CmdV)on update cascade on delete cascade,
	IDCmdReg int primary key AUTO_INCREMENT );

/*===================================== Utilisateur ==============================================*/

	CREATE TABLE  Utilisateur(
	Id_user int primary key AUTO_INCREMENT NOT NULL,
	Email varchar(255) NOT NULL,
	Password varchar(255) NOT NULL,
    Role varchar(20)
    );

/*======================================== Charge =================================================*/

	CREATE TABLE  Charge(
	Id_chrge int primary key AUTO_INCREMENT,
	Nom_charge varchar(100),
	Date_charge date,
	Montant float);

/*======================================== Production ==============================================*/

    CREATE TABLE Production (
        Id_production int primary key  AUTO_INCREMENT NOT NULL,
        Date_Debut date,
        Date_Fin date,
        Id_Clt int ,foreign key (Id_Clt) references Client (Id_Clt) on UPDATE CASCADE ON DELETE CASCADE
    );

/*======================================== Dt_Production ===========================================*/

    CREATE TABLE Dt_Production (
        Id_Dtprod int primary key AUTO_INCREMENT NOT NULL,
        Id_production int,
        Id_prod int,
        QteP float,
        PrixUnite float NULL,
        foreign key (Id_production) references Production(Id_production) on update cascade on delete cascade,
        foreign key (Id_prod) references Produit(Id_prod) on update cascade on delete cascade
    );

/*======================================== Sous_Produit ============================================*/

    CREATE TABLE Sous_Produit (
         Id_Dtprod int , 
         Id_prod int  , 
         QteUnite float ,
         PrixUnite float,
         foreign key (Id_prod) references Produit(Id_prod) on update cascade on delete cascade,
         foreign key (Id_Dtprod) references Dt_Production (Id_Dtprod) on update cascade on delete cascade
    );

/*======================================== ArchiveStock ============================================*/

    CREATE TABLE  ArchiveStock(
	NumArch int primary key AUTO_INCREMENT NOT NULL,
	DateArch date NOT NULL,
	Id_Prod  int,  foreign key  (Id_Prod) references Produit(Id_Prod) on update cascade on delete cascade,
	Stock float NULL,
	QteS float NULL,
	MontantS float NULL,
	QteE float NULL,
	MontantE float NULL);

    --========================================================================
	--===                           Triggers                               ===
	--========================================================================
    
    Create Trigger  MajStock_Delete After DELETE 
    On  DetailAchat FOR EACH ROW
        Begin
                Update  Produit  Set QteS -=  
                (Select Sum(Qte) From deleted 
                Where Id_Prod = a.Id_Prod
                Group By Id_Prod)  
                From Produit a
                Join deleted b On a.Id_Prod = b.Id_Prod
        End
    
 --===========================================================================+

    Create Trigger  MajStock_Insert  After INSERT
    On  DetailAchat	FOR EACH ROW
        Begin
                Declare @QteS float, @Stock float, @QteE float
                    Update Produit Set QteS = QteS + 
                    (Select Sum(Qte) From inserted 
                    Where Id_Prod = a.Id_Prod
                    Group By Id_Prod)  
                    From Produit a
                    Join inserted b On a.Id_Prod = b.Id_Prod
                    if((select count(Stock) from ArchiveStock) = 0 ) begin
                        insert into ArchiveStock values(cast(GetDate() as date),(select Id_Prod from inserted),0,0,0,(select Qte from inserted),(select PrixA from inserted))
        End
         else
        begin 
                set @QteS = (select top 1 QteS from ArchiveStock order by NumArch desc)
                set @QteE = (select top 1 QteE from ArchiveStock order by NumArch desc)
                set @Stock =(select top 1 Stock from ArchiveStock order by NumArch desc)

                insert into ArchiveStock values(cast(GetDate() as date),(select Id_Prod from inserted),(@Stock + @QteE) - @QteS,0,0,(select Qte from inserted),(select PrixA from inserted))
            end 
        End
    
--============================================================================

    Create Trigger  MajStock_Update  After UPDATE
    On  DetailAchat FOR EACH ROW    
    Begin
            Update Produit Set QteS = QteS -
            (Select Sum(Qte) From deleted 
            Where Id_Prod = a.Id_Prod
            Group By Id_Prod) 
            From Produit a
            Join deleted b On a.Id_Prod = b.Id_Prod
            
            Update Produit Set QteS = QteS  +
            (Select Sum(Qte) From inserted 
            Where Id_Prod = a.Id_Prod
            Group By Id_Prod)  
            From Produit a
            Join inserted c On a.Id_Prod = c.Id_Prod
    End
    
 --===========================================================================

    Create trigger  MajSolde_insert after insert
    on  DetailReg  FOR EACH ROW
    begin
            update Client set Solde = Solde - Montant
            from Client
            inner join CommandeVente on Client.Num_Clt=CommandeVente.Num_Clt
            inner join DetailReg on CommandeVente.Num_CmdV=DetailReg.Num_CmdV
            inner join Reglement on Reglement.Num_Reg = DetailReg.Num_Reg
            where DetailReg.Num_Reg=(select Num_Reg from inserted) and DetailReg.Num_CmdV=(select Num_CmdV from inserted)
    end
    
 --===========================================================================    

    Create Trigger  MajStock_DeleteV After DELETE
    On  DetailVente FOR EACH ROW
    Begin
            Update Produit Set QteS = QteS +
            (Select Sum(Qte) From deleted
            Where Id_Prod = a.Id_Prod
            Group By Id_Prod)  
            From Produit a
            Join deleted b On a.Id_Prod = b.Id_Prod
            update Client set Solde = Solde - (Select Sum(PrixV*Qte) From deleted) 
            from Client
            inner join CommandeVente on Client.Num_Clt=CommandeVente.Num_Clt
            where Num_CmdV = (select Top 1 Num_CmdV from deleted) 
    End
    
 --===========================================================================    
    Create Trigger  MajStock_InsertV After INSERT
    On  DetailVente FOR EACH ROW
        Begin
        Declare @QteS float, @Stock float, @QteE float
            Update Produit Set QteS = QteS - 
            (Select Sum(Qte) From inserted 
            Where Id_Prod = a.Id_Prod
            Group By Id_Prod)  
            From Produit a
            Join inserted b On a.Id_Prod = b.Id_Prod

            update Client set Solde = Solde + (Select Sum(PrixV*Qte) From inserted) 
            from Client
            inner join CommandeVente on Client.Num_Clt=CommandeVente.Num_Clt
            where Num_CmdV = (select Num_CmdV from inserted) 
                if((select count(Stock) from ArchiveStock) = 0 ) begin
                insert into ArchiveStock values(cast(GetDate() as date),(select Id_Prod from inserted),0,(select Qte from inserted),(select PrixV from inserted),0,0)
            end
            else
            Begin 
                set @QteS = (select top 1 QteS from ArchiveStock order by NumArch desc)
                set @QteE = (select top 1 QteE from ArchiveStock order by NumArch desc)
                set @Stock =(select top 1 Stock from ArchiveStock order by NumArch desc)

                Insert into ArchiveStock values(cast(GetDate() as date),(select Id_Prod from inserted),(@Stock + @QteE) - @QteS,(select Qte from inserted),(select PrixV from inserted),0,0)
            End 
        End
 --================================================================================

    Create Trigger  MajStock_UpdateV After UPDATE

        On  DetailVente FOR EACH ROW
        Begin
        Update Produit Set QteS = QteS +
            (Select Sum(Qte) From deleted 
            Where Id_Prod = a.Id_Prod
            Group By Id_Prod) 
            From Produit a
            Join deleted b On a.Id_Prod = b.Id_Prod
            
            Update Produit Set QteS = QteS  -
            (Select Sum(Qte) From inserted 
            Where Id_Prod = a.Id_Prod
            Group By Id_Prod)  
            From Produit a
            Join inserted c On a.Id_Prod = c.Id_Prod

            update Client set Solde -= (Select Sum(PrixV*Qte) From deleted)
            from Client
            inner join CommandeVente on Client.Num_Clt=CommandeVente.Num_Clt
            where Num_CmdV = (select Num_CmdV from deleted) 
            update Client set Solde += (Select Sum(PrixV*Qte) From inserted)
            from Client
            inner join CommandeVente on Client.Num_Clt=CommandeVente.Num_Clt
            where Num_CmdV = (select Num_CmdV from inserted) 
        End